<?php

return [
    'app_name' => 'Safecart',
    'super_admin_role_id' => 3,
    'admin_model' => \Modules\AdminManage\Entities\Admin::class,
    'admin_table' => 'admins',
    'multi_tenant' => false,
    'author' => 'byteseed',
    'product_key' => 'ee325e5979048218540bcfb00944c0b1fe513e36',
    'php_version' => '8.1',
    'extensions' => ['BCMath', 'Ctype', 'JSON', 'Mbstring', 'OpenSSL', 'PDO', 'pdo_mysql', 'Tokenizer', 'XML', 'cURL', 'fileinfo'],
    'website' => 'https://bytesed.com',
    'email' => 'support@bytesed.com',
    'env_example_path' => public_path('env-sample.txt'),
    'broadcast_driver' => 'log',
    'cache_driver' => 'file',
    'queue_connection' => 'sync',
    'mail_port' => '587',
    'mail_encryption' => 'tls',
    'model_has_roles' => true,
    'bundle_pack' => false,
    'bundle_pack_key' => '6a17590d8a3b1438f28cb269104e16870e218c02',
];