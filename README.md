# Education Website Project

## Table of Contents
- [Requirements](#Requirements)
- [Database Schema](#Database-Schema)
- [Admin Panel](#Admin-Panel)
- [Filteration & Pagination](#Filteration-&-Pagination)
- [LandPage](#LandPage)
- [Meetings Details](#Meetings-Details)

## Requirements
Components

## Admin Panel

### Sign Up ✅

### Log in ✅

### Add User ✅

### Edit User ✅

### Add Categories ✅

### Manage Categories ✅

#### Listing categories

![image](https://github.com/astral-fate/UN-Women-Back-End-Scholarship/assets/63984422/218feba8-6b2b-4cf3-90cd-4796670e4d70)

#### Deleting not used category
![image](https://github.com/astral-fate/UN-Women-Back-End-Scholarship/assets/63984422/4dcfad97-760a-4de1-8ab3-89764c8c1d79)

#### Deleting used category
![image](https://github.com/astral-fate/UN-Women-Back-End-Scholarship/assets/63984422/c6d55187-3b86-4b0a-bea4-1bfbfd86b02e)


### Add Meetings ✅

### Manage Meetings ✅

![image](https://github.com/astral-fate/UN-Women-Back-End-Scholarship/assets/63984422/37bcc383-a3fa-4513-a203-5ea588e1c361)


## Displaying the name of the logged in user ✅




```

if (isset($_SESSION['Email'])) {
    $email = $_SESSION['Email'];
    try {
        $sql = "SELECT `name` FROM `users` WHERE `Email` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
            $fullName = $user['name'];
        } else {
            $fullName = "User";
        }
    } catch(PDOException $e) {
        $msg = $e->getMessage();
        $alertType = "alert-danger";
    }
} else {
    $fullName = "Guest";
}
?>


Displaying the name of the logged in user

          <div class="profile_info">
            <span>Welcome,</span>
            <h2><?php echo htmlspecialchars($fullName); ?></h2>
          </div>

```

<img width="755" alt="image" src="https://github.com/astral-fate/UN-Women-Back-End-Scholarship/assets/63984422/2c268d6a-15f9-4d74-82d2-097c7a3f7292">

<img width="956" alt="image" src="https://github.com/astral-fate/UN-Women-Back-End-Scholarship/assets/63984422/59e947e1-2c81-4dcb-94e2-94ade9ecb647">


## Query Parameter

## Fragmentation


## Views Of each click

```
ALTER TABLE courses ADD COLUMN click_count INT DEFAULT 0;
```

