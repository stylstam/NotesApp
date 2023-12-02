-- Table for users
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Table for notes
CREATE TABLE Notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    note_title VARCHAR(255) NOT NULL,
    note_content TEXT,
    posted_by VARCHAR(255) NOT NULL,
    FOREIGN KEY (posted_by) REFERENCES Users(username)
);