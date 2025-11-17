<?php 


class UserService{

    public function __construct(
        private UserRepository $repo,
        private PasswordManager $passwords
    ) {}
}