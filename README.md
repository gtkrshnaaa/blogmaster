
# struktur folder views

resources/
└── views/
    ├── admin/
    │   ├── dashboard.blade.php
    │   ├── authors/
    │   │   ├── index.blade.php
    │   │   ├── crate.blade.php
    │   │   └── edit.blade.php
    │   │
    │   ├── posts/
    │   │   ├── index.blade.php
    │   │   ├── crate.blade.php
    │   │   └── edit.blade.php
    │   │
    │   └── categories/
    │        ├── index.blade.php
    │        ├── crate.blade.php
    │        └── edit.blade.php
    │
    ├── author/
    │   ├── dashboard.blade.php
    │   ├── view-posts.blade.php
    │   ├── create-post.blade.php
    │   ├── edit-post.blade.php
    │   └── delete-post.blade.php
    ├── public/
    │   ├── home/
    │   │   └── index.blade.php
    │   └── posts/
    │       └── show.blade.php
    ├── auth/
    │   ├── admin/
    │   │   ├── login.blade.php
    │   │   └── register.blade.php
    │   ├── author/
    │   │      ├── login.blade.php
    │   │      └── register.blade.php
    │   └── passwords/
    │       └── reset.blade.php
    └── layouts/
        ├── app.blade.php
        ├── admin.blade.php
        └── partials/
            ├── header.blade.php
            └── footer.blade.php


# routes

home : http://127.0.0.1:8000/
admin login : http://127.0.0.1:8000/admin/login 
author login : http://127.0.0.1:8000/author/login

# account

admin : admin@example.com
        password