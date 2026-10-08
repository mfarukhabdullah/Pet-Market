import sys, re

file_path = 'c:/Users/ALI_s Computer/Desktop/Pet-clinic/resources/views/seller-listings.blade.php'

with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

media_query = '''
        @media (max-width: 768px) {
            .main-content {
                padding: 16px;
            }
            .welcome-banner {
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
                padding: 24px 20px;
                margin-bottom: 20px;
            }
            .welcome-text {
                width: 100%;
                margin-bottom: 20px;
            }
            .welcome-actions {
                width: 100%;
                justify-content: center;
            }
            .btn-sell {
                width: auto;
                padding: 0 40px;
                height: 48px;
            }
            .btn-notification {
                display: none;
            }

            .status-tabs {
                display: flex;
                overflow-x: auto;
                gap: 12px;
                padding-bottom: 8px;
                margin-bottom: 16px;
                margin-right: -16px;
                padding-right: 16px;
                -ms-overflow-style: none;
                scrollbar-width: none;
                justify-content: flex-start;
            }
            .status-tabs::-webkit-scrollbar {
                display: none;
            }
            .tab-btn {
                width: auto;
                padding: 0 24px;
                height: 44px;
                flex-shrink: 0;
            }

            .listing-card {
                padding: 16px;
                display: grid;
                grid-template-columns: 100px 1fr;
                gap: 16px;
                align-items: flex-start;
            }
            .listing-img-wrapper {
                width: 100px;
                height: 120px;
                grid-column: 1;
                grid-row: 1;
            }
            .listing-info {
                grid-column: 2;
                grid-row: 1;
                gap: 6px;
            }
            .status-badge {
                font-size: 10px;
                padding: 3px 8px;
                margin-bottom: 2px;
            }
            .listing-title {
                font-size: 14px;
                margin-bottom: 0;
            }
            .listing-breed {
                font-size: 12px;
                margin-bottom: 0;
            }
            .listing-price {
                font-size: 14px;
                margin-top: 2px;
            }
            .listing-meta {
                font-size: 11px;
                margin-top: 2px;
                flex-direction: column;
                gap: 2px;
                align-items: flex-start;
            }
            .listing-meta span {
                font-size: 10px;
            }
            .listing-reason {
                font-size: 11px;
                margin-top: 2px;
            }

            .listing-actions {
                grid-column: 1 / -1;
                grid-row: 2;
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                width: 100%;
                gap: 8px;
            }
            .btn-action {
                flex-grow: 1;
                flex-basis: calc(50% - 4px);
                padding: 10px;
                font-size: 13px;
                height: auto;
            }
            .listing-actions .btn-action:first-child:last-child {
                flex-basis: 100%;
            }
            .listing-actions .btn-action:first-child:nth-last-child(3) {
                flex-basis: 100%;
            }
        }
'''

# Find where to inject the media query. Before </style>
if '</style>' in content:
    new_content = content.replace('</style>', media_query + '\n    </style>')
    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(new_content)
    print("Media query added successfully.")
else:
    print("</style> not found.")

