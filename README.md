# 📸 My Blogpost Documentation

---

A simple blogging platform styled with **Tailwind CSS**, it utilizes a **MySQL database** to store Categories, Posts, and Users. Managed through  the **Laragon Herd**  development environment for viewing the latest blog posts about anything.

---

## User Roles

The application defines two distinct roles for users, each with different levels of access and privileges.

- **User:** A standard registered user. After logging in, the user view the post and manage their own profile. ** Standard users can only view posts and manage their own profile.**
- **Admin:** A user with administrative privileges. Admin have full control over the platform's content, including managing all posts and categories.


## Pages and Functionality


### Public Visitors (Not Logged In)
-   **/ (Welcome Page):** The main landing page for the website.

### Registered Users (Logged In)
- **/Blogpost:** The user's can view the post and search for the categories that they want to read for the post.

-   **/profile:** The user's profile page, where they can update their personal information (name, email, password) or delete their account.

### Administrators (Admin Users Only)
-   **/posts:** A management panel giving admins full **CRUD (Create, Read, Update, Delete)** access to all posts on the platform.

-   **/categories:** A management panel for admins with full **CRUD (Create, Read, Update, Delete)** access for all content categories.
