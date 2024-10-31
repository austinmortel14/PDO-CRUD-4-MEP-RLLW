CREATE TABLE Landlord (
    LandlordID INT AUTO_INCREMENT PRIMARY KEY,
    FullName VARCHAR(100),
    ContactNumber VARCHAR(20),
    Email VARCHAR(100),
    HomeAddress TEXT,
    TotalProperties INT,
    DateJoined DATE,
    ManagementFeePercentage DECIMAL(5, 2)
);

CREATE TABLE Tenant (
    TenantID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    DateOfBirth DATE,
    Email VARCHAR(100),
    PhoneNumber VARCHAR(20),
    LeaseStartDate DATE,
    LeaseEndDate DATE,
    LandlordID INT,
    FOREIGN KEY (LandlordID) REFERENCES Landlord(LandlordID) ON DELETE CASCADE
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE changes (
    change_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    change_description TEXT,
    change_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
