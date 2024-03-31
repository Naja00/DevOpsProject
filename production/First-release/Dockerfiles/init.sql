USE mydatabasewissam;

-- Create login table
CREATE TABLE login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL
);

-- Create password_reset_tokens table
CREATE TABLE password_reset_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    token VARCHAR(64) NOT NULL, -- Adjust the length as needed
    expires_at DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Insert some sample data into the login table
INSERT INTO login (email, password, full_name) 
VALUES 
    ('wissamrh02@hotmail.com', 'wissamhassan', 'Wissam Hassan'), 
    ('naja@hotmail.com', 'najanaja', 'Naja Aboghader');
