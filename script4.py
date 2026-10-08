import sys, re

file_path = 'c:/Users/ALI_s Computer/Desktop/Pet-clinic/resources/views/dashboard.blade.php'

with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace using regex between .bottom-grid { ... } and .btn-sell-mobile { ... } inside the media query
pattern = r"(\.favorite-item\s*\{\s*flex-direction:\s*column;\s*align-items:\s*stretch;\s*position:\s*relative;\s*padding:\s*0;\s*overflow:\s*hidden;)"

new_css = '''\.favorite-item {
                flex-direction: column;
                align-items: stretch;
                position: relative;
                padding: 0;
                overflow: hidden;
                border: 0.43px solid #E2E7E3;'''

match = re.search(pattern, content)
if match:
    new_content = content.replace(match.group(1), new_css.replace('\\.', '.'))
    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(new_content)
    print("Replaced successfully.")
else:
    print("Pattern not found.")

