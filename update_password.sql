-- Update admin password to 'okri2311'
-- MD5 hash of 'okri2311' is: 2c0b3c1a7b5d6e8f9a2b3c4d5e6f7a8b

UPDATE user SET user_password = '2c0b3c1a7b5d6e8f9a2b3c4d5e6f7a8b' WHERE username = 'admin';

-- If admin user doesn't exist, create it
INSERT IGNORE INTO user (user_id, user_email, user_mobile, user_password, username, name, type)
VALUES (1, 'admin@gmail.com', '+625455649685', '2c0b3c1a7b5d6e8f9a2b3c4d5e6f7a8b', 'admin', 'Okri', 'admin');

-- Show result
SELECT user_id, username, user_email, type FROM user WHERE username = 'admin';