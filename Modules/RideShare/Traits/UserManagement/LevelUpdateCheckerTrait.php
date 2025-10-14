<?php

namespace Modules\RideShare\Traits\UserManagement;

use App\Models\DeliveryMan;
use App\Models\LoyaltyPointsHistory;
use App\Models\UserLevel;
use App\Models\UserLevelHistory;
use Modules\RideShare\Entities\TransactionManagement\Transaction;
use Modules\RideShare\Entities\TripManagement\RideRequest;
use Modules\RideShare\Entities\TripManagement\RideRequestFee;
use App\Models\UserAccount;
//use Modules\RideShare\Traits\TransactionManagement\TransactionTrait;

trait LevelUpdateCheckerTrait
{
    use UserAccountManagementTrait;

    public function driverLevelUpdateChecker($driver)
    {
        $level = $driver->level;
        $currentSequence = $level->sequence ?? 0;
        $nextLevel = UserLevel::where('user_type', DRIVER)->where('is_active',1)->where('sequence', '>', $currentSequence)->orderBy('sequence', 'asc')->first();
        $userLevelHistory = $this->getUserLevelHistoryByUserLevelId($driver->id,$level->id);

        if ($userLevelHistory == null) {
            $tripTotalEarning = RideRequest::where(['driver_id' => $driver->id, 'payment_status' => PAID])->sum('paid_fare');
            $trip = RideRequest::where(['driver_id' => $driver->id, 'payment_status' => PAID]);
            $adminCommission = RideRequestFee::whereIn('ride_request_id', $trip->pluck('id')->toArray())->sum('admin_commission');
            $totalTrip = $driver?->driverTrips?->count();
            $cancelTrip = RideRequest::where(['driver_id' => $driver->id, 'current_status' => CANCELLED])->count();
            $completedTrip = RideRequest::where(['driver_id' => $driver->id, 'current_status' => COMPLETED])->count();
            $cancellationRate = ($cancelTrip / ($totalTrip == 0 ? 1 : $totalTrip)) * 100;
            $givenReviews = $driver->givenReviews->count();
            $earningAmount = $tripTotalEarning - $adminCommission;

            if ($level->targeted_ride <= $completedTrip && $level->targeted_amount <= $earningAmount && ($level->targeted_cancel >= $cancellationRate || $level->targeted_cancel == 0) && $level->targeted_review <= $givenReviews) {
                $driverLevelStatus = businessConfig('rider_level_feature_status');
                if ($driverLevelStatus && $driverLevelStatus->value == 1) {
                    if ($nextLevel) {
                        $driver->update([
                            'user_level_id' => $nextLevel->id,
                        ]);
                    }
                    $this->createLevelHistory($driver,$level);
                    $this->grantRewardUpdate($level, $driver);

                    $push = getNotification("other_level_up");
                    sendDeviceNotification(fcm_token: $driver->fcm_token,
                        title: translate($push['title']),
                        description: translate(textVariableDataFormat(value: $push['description'],levelName: $nextLevel ? $nextLevel?->name : "")),
                        status: $push['status'],
                        action: $push['action'],
                        user_id: $driver->id,
                        notificationData: [
                            'reward_type' => $level->reward_type,
                            'reward_amount' => $level->reward_amount,
                            'next_level' => $nextLevel ? $nextLevel?->name : null,
                        ]
                    );
                } else {
                    if ($nextLevel) {
                        $driver->update([
                            'user_level_id' => $nextLevel->id,
                        ]);
                    }
                }
            }
        }else{
            $driverLevelStatus = businessConfig('rider_level_feature_status');
            if ($driverLevelStatus && $driverLevelStatus->value == 1) {
                if ($nextLevel) {
                    $driver->update([
                        'user_level_id' => $nextLevel->id,
                    ]);
                    $push = getNotification('other_level_up');
                    sendDeviceNotification(fcm_token: $driver->fcm_token,
                        title: translate($push['title']),
                        description: translate(textVariableDataFormat(value: $push['description'],levelName: $nextLevel ? $nextLevel?->name : "")),
                        status: $push['status'],
                        action: $push['action'],
                        user_id: $driver->id,
                        notificationData: [
                            'reward_type' => "no_rewards",
                            'reward_amount' => $level->reward_amount,
                            'next_level' => $nextLevel ? $nextLevel?->name : null,
                        ]
                    );
                }
            }
        }
        return DeliveryMan::find($driver->id);

    }


    private function levelLoyaltyPointHistory($user_id, $level)
    {
        if ($level->reward_type == 'loyalty_points') {
            $history = new LoyaltyPointsHistory();
            $history->user_id = $user_id;
            $history->user_type = DRIVER;
            $history->model = 'user_level';
            $history->model_id = $level->id;
            $history->points = $level->reward_amount;
            $history->type = 'credit';
            $history->save();
        }
    }

    private function grantRewardUpdate($level, $user): void
    {
        $reward_type = $level->reward_type;
        if ($reward_type == 'loyalty_points') {

            $user->loyalty_points += $level->reward_amount;
            $user->save();

            $history = new LoyaltyPointsHistory();
            $history->user_id = $user->id;
            $history->user_type = DRIVER;
            $history->model = 'user_level';
            $history->model_id = $level->id;
            $history->points = $level->reward_amount;
            $history->type = 'credit';
            $history->save();
        } elseif ($reward_type == 'wallet') {
            //Customer account update
            $driver = $this->getUserAccount($user->id, DRIVER);
            $driver->receivable_balance += $level->reward_amount;
            $driver->save();

             $this->updateDriverBalance($user, 'credit', $level->reward_amount, 'total_earning');

            //customer transaction (credit)
            $primary_transaction = new Transaction();
            $primary_transaction->attribute = 'level_reward';
            $primary_transaction->credit = $level->reward_amount;
            $primary_transaction->balance = $driver->receivable_balance;
            $primary_transaction->user_id = $user->id;
            $primary_transaction->user_type = DRIVER;
            $primary_transaction->account = 'receivable_balance';
            $primary_transaction->save();

        }

    }


    private function getUserLevelHistoryByUserLevelId($userId,$levelId)
    {
        return UserLevelHistory::query()
            ->where(['user_id' => $userId, 'user_level_id' => $levelId])
            ->first();
    }
    private function createLevelHistory($user, $level)
    {
        $history = new UserLevelHistory();
        $history->user_level_id = $level->id;
        $history->user_id = $user->id;
        $history->user_type = DRIVER;
        $history->completed_ride = $level->targeted_ride;
        $history->ride_reward_status = 1;
        $history->total_amount = $level->targeted_amount;
        $history->amount_reward_status = 1;
        $history->cancellation_rate = $level->targeted_cancel;
        $history->cancellation_reward_status = 1;
        $history->reviews = $level->targeted_review;
        $history->reviews_reward_status = 1;
        $history->is_level_reward_granted = 1;
        $history->save();

        return $history;
    }

}

