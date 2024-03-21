
<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>


# Employee Test Project

This project utilizes Laravel, Queues, Laravel Excel, and MySQL to accomplish the required tasks.

## Commands

To set up the project locally, follow these steps:

1. Create a database named `localbrand` in your MySQL server.
   
   ```bash
   mysql -u your_username -p -e "CREATE DATABASE localbrand;"
   ```
   
2. Run the migrations to create the necessary database tables.
   
   ```bash
   php artisan migrate
   ```

3. Start the development server.
   
   ```bash
   php artisan serve
   ```

4. Run the queue worker to process queued jobs.
   
   ```bash
   php artisan queue:work --queue=high,default
   ```

Now, you can access the project on your local host.

## Additional Information

In this project, we have utilized jobs to handle time-consuming tasks asynchronously. This ensures that users don't experience delays while performing operations such as importing Excel files.

Moreover, it's essential to implement authentication in real-world projects to ensure data security and user privacy.

When dealing with large Excel files, it's crucial to consider CPU and memory usage. Laravel Excel helps in handling large files efficiently by utilizing chunking, dividing the work into smaller parts to prevent overwhelming the system.

In summary, this README covers the setup process and additional considerations for handling Excel imports efficiently in a Laravel project.
