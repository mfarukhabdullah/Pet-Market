<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Moderation & Security Shield - Pet Marketplace</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">

    <style>
        body {
            background-color: #F8FAF9;
            font-family: 'DM Sans', sans-serif;
            color: #17211C;
            margin: 0;
            padding: 0;
        }

        .admin-wrap {
            max-width: 1400px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #147A4D;
            color: white;
            padding: 24px 32px;
            border-radius: 16px;
            margin-bottom: 28px;
            box-shadow: 0 4px 20px rgba(20, 122, 77, 0.15);
        }

        .admin-header h1 {
            margin: 0 0 6px;
            font-family: 'Outfit', sans-serif;
            font-size: 26px;
            font-weight: 700;
        }

        .admin-header p {
            margin: 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .admin-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            padding: 22px 24px;
            border-radius: 14px;
            border: 1px solid #E2E8F0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-card .val {
            font-size: 28px;
            font-weight: 800;
            font-family: 'Outfit', sans-serif;
            color: #17211C;
        }

        .stat-card .lbl {
            font-size: 13px;
            color: #64748B;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 4px;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .icon-green { background: rgba(20, 122, 77, 0.1); color: #147A4D; }
        .icon-amber { background: rgba(245, 158, 11, 0.1); color: #F59E0B; }
        .icon-red { background: rgba(239, 68, 68, 0.1); color: #EF4444; }
        .icon-blue { background: rgba(59, 130, 246, 0.1); color: #3B82F6; }

        .admin-section {
            background: white;
            border-radius: 16px;
            border: 1px solid #E2E8F0;
            padding: 28px;
            margin-bottom: 32px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        }

        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-head h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            color: #17211C;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .admin-table th {
            padding: 12px 16px;
            background: #F8FAFC;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: #64748B;
            border-bottom: 1px solid #E2E8F0;
        }

        .admin-table td {
            padding: 16px;
            border-bottom: 1px solid #F1F5F9;
            font-size: 14px;
            vertical-align: middle;
        }

        .badge-pending {
            background: #FEF3C7;
            color: #92400E;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .btn-action {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            transition: opacity 0.2s;
        }

        .btn-approve { background: #147A4D; color: white; }
        .btn-reject { background: #F1F5F9; color: #475569; }
        .btn-ban { background: #EF4444; color: white; }
        .btn-action:hover { opacity: 0.85; }

        .item-preview {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .item-thumb {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            object-fit: cover;
        }

        .item-info .title {
            font-weight: 700;
            color: #17211C;
            text-decoration: none;
        }

        .item-info .meta {
            font-size: 12px;
            color: #64748B;
            margin-top: 2px;
        }

        @media(max-width: 900px) {
            .admin-stats-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Header Component -->
    <x-header />

    <div class="admin-wrap">
        <!-- Top Banner -->
        <div class="admin-header">
            <div>
                <h1>🛡️ Platform Moderation & Anti-Scam Shield</h1>
                <p>Real-time queue monitoring, fraud detection, and pet listing verification</p>
            </div>
            <div>
                <a href="{{ route('home') }}" style="background: white; color: #147A4D; padding: 10px 18px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px;">View Public Site</a>
            </div>
        </div>

        @if(session('success'))
            <div style="background: #DEF7EC; color: #03543F; padding: 14px 20px; border-radius: 10px; margin-bottom: 24px; font-weight: 600;">
                <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('info'))
            <div style="background: #E1EFFE; color: #1E429F; padding: 14px 20px; border-radius: 10px; margin-bottom: 24px; font-weight: 600;">
                <i class="fa-solid fa-circle-info" style="margin-right: 8px;"></i> {{ session('info') }}
            </div>
        @endif

        <!-- Stats Grid -->
        <div class="admin-stats-grid">
            <div class="stat-card">
                <div>
                    <div class="val">{{ $stats['total_users'] }}</div>
                    <div class="lbl">Registered Users</div>
                </div>
                <div class="stat-icon icon-blue"><i class="fa-solid fa-users"></i></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="val">{{ $stats['live_listings'] }}</div>
                    <div class="lbl">Live Listings</div>
                </div>
                <div class="stat-icon icon-green"><i class="fa-solid fa-paw"></i></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="val">{{ $stats['pending_listings'] }}</div>
                    <div class="lbl">Pending Approval</div>
                </div>
                <div class="stat-icon icon-amber"><i class="fa-solid fa-clock-rotate-left"></i></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="val">{{ $stats['total_reports'] }}</div>
                    <div class="lbl">Fraud Reports</div>
                </div>
                <div class="stat-icon icon-red"><i class="fa-solid fa-shield-triangle-exclamation"></i></div>
            </div>
        </div>

        <!-- Section 1: Pending Listings Queue -->
        <div class="admin-section">
            <div class="section-head">
                <h2>Pending Listings Queue ({{ $pendingListings->count() }})</h2>
                <span class="badge-pending">Needs Manual Review</span>
            </div>

            <div style="overflow-x: auto;">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Listing</th>
                            <th>Seller</th>
                            <th>Price</th>
                            <th>Location</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingListings as $listing)
                            <tr>
                                <td>
                                    <div class="item-preview">
                                        <img src="{{ $listing->primary_image_url }}" class="item-thumb" alt="">
                                        <div class="item-info">
                                            <a href="{{ route('pet.details', ['id' => $listing->id]) }}" class="title" target="_blank">{{ $listing->title }}</a>
                                            <div class="meta">{{ $listing->category ? $listing->category->name : 'General' }} • {{ $listing->breed_name ?: ($listing->breed ? $listing->breed->name : 'N/A') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>{{ $listing->user->name }}</strong>
                                    <div style="font-size: 12px; color: #64748B;">Trust: {{ $listing->user->trust_score }}%</div>
                                </td>
                                <td><strong>{{ $listing->formatted_price }}</strong></td>
                                <td>{{ $listing->city }}</td>
                                <td>{{ $listing->created_at->diffForHumans() }}</td>
                                <td>
                                    <div style="display: flex; gap: 8px;">
                                        <form action="{{ route('admin.listings.approve', ['id' => $listing->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-action btn-approve"><i class="fa-solid fa-check"></i> Approve</button>
                                        </form>
                                        <form action="{{ route('admin.listings.reject', ['id' => $listing->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="reason" value="Suspicious listing or unverified health paperwork">
                                            <button type="submit" class="btn-action btn-reject"><i class="fa-solid fa-xmark"></i> Reject</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: #64748B; padding: 32px;">
                                    <i class="fa-solid fa-check-double" style="font-size: 24px; color: #147A4D; margin-bottom: 8px; display: block;"></i>
                                    All clear! No listings currently waiting in the moderation queue.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section 2: User Fraud & Scam Reports -->
        <div class="admin-section">
            <div class="section-head">
                <h2>User Fraud & Abuse Reports ({{ $recentReports->count() }})</h2>
                <span style="background: #FEE2E2; color: #991B1B; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 700;">Anti-Scam Alert</span>
            </div>

            <div style="overflow-x: auto;">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Report Reason</th>
                            <th>Details</th>
                            <th>Reported Seller</th>
                            <th>Reporter</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentReports as $report)
                            <tr>
                                <td><strong style="color: #EF4444;">{{ $report->reason }}</strong></td>
                                <td style="max-width: 300px; color: #475569;">{{ $report->details ?: 'No additional notes provided' }}</td>
                                <td>
                                    @if($report->seller)
                                        <strong>{{ $report->seller->name }}</strong>
                                        <div style="font-size: 12px; color: #64748B;">{{ $report->seller->email }}</div>
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </td>
                                <td>{{ $report->reporter ? $report->reporter->name : 'Anonymous' }}</td>
                                <td>{{ $report->created_at->diffForHumans() }}</td>
                                <td>
                                    @if($report->seller_id)
                                        <form action="{{ route('admin.users.ban', ['id' => $report->seller_id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to ban this user and delete all their active ads?');">
                                            @csrf
                                            <button type="submit" class="btn-action btn-ban"><i class="fa-solid fa-ban"></i> Ban Scammer</button>
                                        </form>
                                    @else
                                        <span style="color: #94A3B8; font-size: 12px;">Resolved</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: #64748B; padding: 32px;">
                                    <i class="fa-solid fa-shield-cat" style="font-size: 24px; color: #147A4D; margin-bottom: 8px; display: block;"></i>
                                    No pending reports! Community is running safe and sound.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Footer Component -->
    <x-footer />

</body>
</html>
