USE habede;

CREATE TABLE user (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(256) NOT NULL,
    password VARCHAR(256) NOT NULL,
    username VARCHAR(256) NOT NULL,
    nama VARCHAR(256) NOT NULL,
    isAdmin BOOLEAN NOT NULL DEFAULT false
);

CREATE TABLE album (
    album_id INT AUTO_INCREMENT PRIMARY KEY,
    Judul VARCHAR(64) NOT NULL,
    Penyanyi VARCHAR(128) NOT NULL,
    Total_duration INT NOT NULL DEFAULT 0,
    Image_path VARCHAR(256) NOT NULL,
    Tanggal_terbit DATE NOT NULL,
    Genre VARCHAR(64)
);

CREATE TABLE song (
    song_id INT AUTO_INCREMENT PRIMARY KEY,
    Judul VARCHAR(64) NOT NULL,
    Penyanyi VARCHAR(128),
    Tanggal_terbit DATE NOT NULL,
    Genre VARCHAR(64),
    Duration INT NOT NULL,
    Audio_path VARCHAR(256) NOT NULL,
    Image_path VARCHAR(256),
    album_id INT,
    FOREIGN KEY (album_id) REFERENCES album (album_id) ON DELETE CASCADE
);

INSERT INTO user VALUES (1, 'admin@gmail.com', '$2y$10$DVwuawj2W0iigY8zl/4JI.TT.Bb2GcV6D2B2ipz79va49Xmv.O1qm', 'admin', 'Admin', true);