import os
import glob

search_text = '''                <button class=\"btn-notification\">
                    <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                        <path d=\"M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9\"></path>
                        <path d=\"M13.73 21a2 2 0 0 1-3.46 0\"></path>
                    </svg>
                </button>'''

replace_text = '                <x-notification-bell />'

search_text2 = '''            <button class=\"btn-notification\">
                <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                    <path d=\"M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9\"></path>
                    <path d=\"M13.73 21a2 2 0 0 1-3.46 0\"></path>
                </svg>
            </button>'''
            
replace_text2 = '            <x-notification-bell />'

search_text3 = '''                        <button class=\"btn-notification\">
                            <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                                <path d=\"M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9\"></path>
                                <path d=\"M13.73 21a2 2 0 0 1-3.46 0\"></path>
                            </svg>
                        </button>'''
                        
replace_text3 = '                        <x-notification-bell />'

# dashboard case
search_text4 = '''                <button class=\"btn-notification\">
                    <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                        <path d=\"M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9\"></path>
                        <path d=\"M13.73 21a2 2 0 0 1-3.46 0\"></path>
                    </svg>
                </button>'''
replace_text4 = '                <x-notification-bell />'

files = glob.glob('resources/views/**/*.blade.php', recursive=True)
count = 0
for f in files:
    if 'components' in f and 'header' not in f: continue
    with open(f, 'r', encoding='utf-8') as file:
        data = file.read()
    
    original = data
    data = data.replace(search_text, replace_text)
    data = data.replace(search_text2, replace_text2)
    data = data.replace(search_text3, replace_text3)
    data = data.replace(search_text4, replace_text4)
    
    if data != original:
        with open(f, 'w', encoding='utf-8') as file:
            file.write(data)
        print(f'Replaced in {f}')
        count += 1

print(f'Replaced in {count} files total')
