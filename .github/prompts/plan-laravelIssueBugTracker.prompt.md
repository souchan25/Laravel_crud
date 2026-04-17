## Plan: Laravel Issue & Bug Tracker MVP

A mini-Jira tailored for student teams built with Laravel (Blade + Tailwind), storing data in a Supabase PostgreSQL database, and configured for Render deployment. We will use Laravel Breeze to quickly bootstrap authentication and Tailwind CSS.

**Steps**

**Phase 1: Project Setup & Config**
1. Create a new Laravel project.
2. Install Laravel Breeze (Blade stack) to instantly configure Tailwind CSS and User Authentication.
3. Update `.env` with Supabase PostgreSQL credentials and SSL configuration.

**Phase 2: Database Design & Models**
4. Generate models and migrations for `Ticket` and `Comment`.
   - `Ticket`: title, description, status (open, in-progress, resolved), priority (low, medium, high), type (bug, feature), user_id (reporter), assignee_id.
   - `Comment`: content, user_id, ticket_id.
5. Define Eloquent relationships (e.g., Ticket belongsTo User as Assignee, Ticket hasMany Comments).
6. Create Database Seeders to populate dummy users and initial tickets for testing.

**Phase 3: Controllers & Routing**
7. Create `TicketController` to handle Kanban view (index), ticket creation (store), updating (update), and deletion (destroy).
8. Create `CommentController` to handle adding development notes to tickets.
9. Register resource routes in `web.php` protected by standard `auth` middleware.

**Phase 4: Frontend (Blade + Tailwind)**
10. Build the `tickets.index` view: A 3-column Kanban board displaying cards for Open, In-Progress, and Resolved.
11. Build the `tickets.create` view: Form to outline issues/features and assign teammates.
12. Build the `tickets.show`/`edit` view: Display details, allow status/priority/assignee updates, and list/add comments.

**Phase 5: Render Deployment Prep**
13. Create a `.gitignore` adjustment and build scripts (or `render.yaml` if preferred) for Render's PHP/Composer environment.
14. Document environment variables needed for Render dashboard.

**Relevant files**
- `.env` — Supabase connection
- `database/migrations/*` — Schema definition
- `app/Models/Ticket.php`, `app/Models/User.php`, `app/Models/Comment.php` — App relationships
- `app/Http/Controllers/TicketController.php` — Main CRUD logic
- `resources/views/tickets/index.blade.php` — Main Kanban UI

**Verification**
1. Run `php artisan migrate:fresh --seed` to verify Supabase connection and schema.
2. Authenticate locally, create a new Ticket, and assign it to a teammate.
3. Change ticket status and verify it moves across the Kanban columns.
4. Add a comment and ensure it renders under the ticket details.
5. Validate Render build script runs correctly (`composer install && npm run build`).

**Decisions**
- Using Laravel Breeze for rapid UI/Auth scaffolding.
- Implementing a 3-column CSS Grid Kanban board for the Read requirement over a basic table, as it better fits the "mini-Jira" goal.

**Further Considerations**
1. Do you prefer a `render.yaml` Blueprint file for Infrastructure-as-Code deployment, or just instructions on how to hook up the Git repo in the Render dashboard?
2. Are you okay with using Laravel Breeze for out-of-the-box user login & registration to act as our "team members"?
