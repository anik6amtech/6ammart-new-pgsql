<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OauthClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_clients')->delete();
        
        \DB::table('oauth_clients')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'qBN0j6SW6nIf47748tgxaKxnqKqCacTxa6gii8yc',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2021-08-19 20:44:50',
                'updated_at' => '2021-08-19 20:44:50',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'oqQ90HOU0egjgQ01LRzHo9rADUavq16jzWm1TrjT',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2021-08-19 20:44:50',
                'updated_at' => '2021-08-19 20:44:50',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => NULL,
                'name' => 'stackfood Personal Access Client',
                'secret' => 'iRxXixYp4CDo7TWbWNCMelAUwgtScaEMGudnbHQk',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2022-01-05 10:22:36',
                'updated_at' => '2022-01-05 10:22:36',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => NULL,
                'name' => 'stackfood Password Grant Client',
                'secret' => 'FzGJ1vSlbfGP2mWqF6V575QgVCEfbBHVNA41ApeC',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2022-01-05 10:22:36',
                'updated_at' => '2022-01-05 10:22:36',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'bQXYroRN22vNSgG4RyEmQBIsD323AZcn1B4uhXZ3',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2022-03-14 17:46:33',
                'updated_at' => '2022-03-14 17:46:33',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'g8jDGgVvxZtRN5FTUssFvvxQlgRki7LqjbY68wii',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2022-03-14 17:46:33',
                'updated_at' => '2022-03-14 17:46:33',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'GfMSUTo1mJF4A2yV9xMM9qL90wlVAGxGW2MftUI3',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2022-03-16 15:09:13',
                'updated_at' => '2022-03-16 15:09:13',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'lyzdL09G1bz7vs6oh2LchwjJXOXyI6SyclmdPw27',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2022-03-16 15:09:13',
                'updated_at' => '2022-03-16 15:09:13',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => NULL,
                'name' => '6ammart1648729079 Personal Access Client',
                'secret' => 'mLFcLOAkQZopdECWj0ROMohdCHpJYLli4mCsFUp8',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2022-09-29 12:16:18',
                'updated_at' => '2022-09-29 12:16:18',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => NULL,
                'name' => '6ammart1648729079 Password Grant Client',
                'secret' => '0gtRK3FF5HCy1WQPuNFVPBqtawqhHwEGwYlo2D1T',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2022-09-29 12:16:18',
                'updated_at' => '2022-09-29 12:16:18',
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => NULL,
                'name' => '6ammart Personal Access Client',
                'secret' => 'n5j05MA5tw4yDDR00kP2zEscm8OAa7x9oJ0Y2kB7',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2024-10-22 14:25:22',
                'updated_at' => '2024-10-22 14:25:22',
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => NULL,
                'name' => '6ammart Password Grant Client',
                'secret' => 'Ohbi1uVW6q3nx9mHurr3TqF4hbIXz9ZBB6QaWsii',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2024-10-22 14:25:22',
                'updated_at' => '2024-10-22 14:25:22',
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'weYDnHLG6jRtiwu34ySQBUXFzDzEJ188n3JQ4g1E',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2025-02-05 13:02:56',
                'updated_at' => '2025-02-05 13:02:56',
            ),
            13 => 
            array (
                'id' => 14,
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'Jnik7QBm2t3IyMXTBdeRyCjavcfQPa51VJAkkz19',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2025-02-05 13:02:56',
                'updated_at' => '2025-02-05 13:02:56',
            ),
            14 => 
            array (
                'id' => 15,
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'r9C5wzGm2OateLnpjnFsNTM2ysAVYYplwpgkrGGA',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2025-02-05 16:51:11',
                'updated_at' => '2025-02-05 16:51:11',
            ),
            15 => 
            array (
                'id' => 16,
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'L88XCvDSbP8z6rZlfsrdBXQVsTytXyOV0i1l4gjN',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2025-02-05 16:51:11',
                'updated_at' => '2025-02-05 16:51:11',
            ),
            16 => 
            array (
                'id' => 17,
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'Jb6BrRjpz8rQSU6gBk78wTwHixa8GtfxDUZH4yx4',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2025-02-06 12:02:16',
                'updated_at' => '2025-02-06 12:02:16',
            ),
            17 => 
            array (
                'id' => 18,
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'fFBUTH78ybSYZLH90fjSXv9DgAAu3J3nF7zPtDPS',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2025-02-06 12:02:16',
                'updated_at' => '2025-02-06 12:02:16',
            ),
            18 => 
            array (
                'id' => 19,
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'fXiWf2WmntrOsJ9IUM5mMFXp0TVpynPk5eXkGKtn',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2025-02-06 17:27:49',
                'updated_at' => '2025-02-06 17:27:49',
            ),
            19 => 
            array (
                'id' => 20,
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => '1fxLm3MAyefJHJCHN5gJICOZOuCWHYxjpCsYoKSl',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2025-02-06 17:27:49',
                'updated_at' => '2025-02-06 17:27:49',
            ),
            20 => 
            array (
                'id' => 21,
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'DMCz1ismUVPPLJ5ZuQoOjOsFGYKZ3GCl7p9Z13EU',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2025-09-10 16:29:15',
                'updated_at' => '2025-09-10 16:29:15',
            ),
            21 => 
            array (
                'id' => 22,
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'g66kOytTraCFNaAA5mi3c3aSQcIAgdup7DZvNVQC',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2025-09-10 16:29:15',
                'updated_at' => '2025-09-10 16:29:15',
            ),
        ));
        
        
    }
}