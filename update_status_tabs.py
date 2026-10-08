import re

file_path = 'c:/Users/ALI_s Computer/Desktop/Pet-clinic/resources/views/seller-listings.blade.php'
with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace mobile status-tabs block
pattern = r'(\s*\.status-tabs\s*\{\s*display:\s*flex;\s*gap:\s*8px;\s*margin-bottom:\s*16px;\s*justify-content:\s*)space-between;(\s*\})'
replacement = r'\1flex-start;\n                overflow-x: auto;\n                padding-bottom: 4px;\n                -ms-overflow-style: none;\n                scrollbar-width: none;\2'

new_content = re.sub(pattern, replacement, content, count=1)

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(new_content)
print('Updated seller-listings.blade.php')
