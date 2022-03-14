<?php
echo'=admin123=';
echo password_hash("admin123",PASSWORD_BCRYPT);
echo'=user1234=';
echo password_hash("user1234",PASSWORD_BCRYPT);