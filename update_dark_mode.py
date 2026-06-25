import os
import re

directory = 'c:/Users/Advan/OneDrive/Desktop/TailorPro/resources/views'

replacements = [
    # Backgrounds for cards, panels, inputs
    (r'dark:bg-slate-900', r'dark:bg-secondary'),
    (r'dark:bg-slate-800(?:/30|/50|/80)?', r'dark:bg-secondary'),
    (r'dark:bg-slate-850', r'dark:bg-secondary'),
    (r'dark:bg-gray-800', r'dark:bg-secondary'),
    (r'dark:bg-gray-900', r'dark:bg-secondary'),
    
    # Borders (to accent)
    (r'dark:border-slate-800(?:/80|/70|/50)?', r'dark:border-accent'),
    (r'dark:border-slate-700(?:/80)?', r'dark:border-accent'),
    
    # Text
    (r'dark:text-white', r'dark:text-text'),
    (r'dark:text-slate-100', r'dark:text-text'),
    (r'dark:text-slate-300', r'dark:text-text'),
    (r'dark:text-slate-400', r'dark:text-text'),
    (r'dark:text-gray-400', r'dark:text-text'),
    
    # Hovers (bg to accent, border to accent)
    (r'dark:hover:bg-slate-800', r'dark:hover:bg-accent'),
    (r'dark:hover:bg-slate-700', r'dark:hover:bg-accent'),
    (r'dark:hover:border-slate-700', r'dark:hover:border-accent'),
]

for root, _, files in os.walk(directory):
    for file in files:
        if file.endswith('.blade.php'):
            filepath = os.path.join(root, file)
            with open(filepath, 'r', encoding='utf-8') as f:
                content = f.read()
            
            new_content = content
            for old, new in replacements:
                new_content = re.sub(old, new, new_content)
                
            if content != new_content:
                with open(filepath, 'w', encoding='utf-8') as f:
                    f.write(new_content)
                print(f"Updated {filepath}")
