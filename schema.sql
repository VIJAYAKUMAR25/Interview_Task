CREATE DATABASE IF NOT EXISTS wpoets_test;
USE wpoets_test;

CREATE TABLE IF NOT EXISTS slides (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tab_name VARCHAR(255) NOT NULL,
    tab_icon_path VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    link VARCHAR(255) NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert dummy data based on the design
INSERT INTO slides (tab_name, tab_icon_path, category, title, link, image_path) VALUES 
('Learning', 'files/images/DL-learning.svg', 'DIGITAL LEARNING INFRASTRUCTURE', 'Usability enhancement and Training for Transaction Portal for Customers', '#', 'files/images/DL-Learning-1.jpg'),
('Technology', 'files/images/DL-technology.svg', 'TECHNOLOGY ENABLEMENT', 'Seamless integration of disparate systems for unified workflow', '#', 'files/images/DL-Technology.jpg'),
('Communication', 'files/images/DL-communication.svg', 'STRATEGIC COMMUNICATION', 'Enhancing corporate communication through robust digital platforms', '#', 'files/images/DL-Communication.jpg');
