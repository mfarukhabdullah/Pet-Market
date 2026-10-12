<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Pet Marketplace</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS for Header/Footer -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">
    <style>
        :root {
            --primary-green: #128c5a;
            --bg-color: #f7f9f8;
            --text-dark: #1f2937;
            --text-gray: #6b7280;
            --border-color: #e5e7eb;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-dark); display: flex; flex-direction: column; min-height: 100vh; }
        .main-content { width: 100%; flex-grow: 1; padding: 40px 0; }
        
        /* =========================================================
           [AI UPDATE - START]
           User Prompt: "just remove welcome banner from Notificiation page"
           Description: Removed welcome-banner styles and restored clean notifications-header layout.
           ========================================================= */
        .notifications-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .notifications-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }
        .notifications-header p {
            font-size: 15px;
            color: #6b7280;
            margin: 0;
        }
        /* =========================================================
           [AI UPDATE - END]
           ========================================================= */

        .btn-mark-read {
            background-color: var(--primary-green);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 16px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: opacity 0.2s;
        }
        .btn-mark-read:hover { opacity: 0.9; }

        .empty-notifications {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 120px 24px;
            text-align: center;
            color: #9ca3af;
            font-size: 15px;
        }

        @media (max-width: 768px) {
            .main-content { padding: 24px 20px; }
            .notifications-header { flex-direction: column; align-items: flex-start; gap: 16px; }
            .notifications-header h1 { font-size: 22px; }
            .empty-notifications { padding: 80px 20px; }
            
            /* Hide footer on mobile for dashboard-like pages */
            footer, .pet-footer { display: none !important; }
        }
    </style>
</head>
<body>

    <x-header />

    <!-- Main Content -->
    <div class="shell-1440" style="margin: 0 auto; width: 100%; flex-grow: 1; display: flex; flex-direction: column;">
        <div class="container" style="flex-grow: 1; display: flex; flex-direction: column;">
            <main class="main-content">
                {{-- [AI UPDATE] User Prompt: "just remove welcome banner from Notificiation page" (Removed welcome banner and restored notifications-header) --}}
                <div class="notifications-header">
                    <div>
                        <h1>All Notifications</h1>
                        <p>View and manage your recent notifications</p>
                    </div>
                    <button class="btn-mark-read">
                        <i class="fa-regular fa-circle-check"></i> Mark all as read
                    </button>
                </div>

                <div class="empty-notifications">
                    You have no notifications
                </div>
            </main>
        </div>
    </div>

    <x-footer />
</body>
</html>
