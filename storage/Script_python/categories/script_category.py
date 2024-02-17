from bs4 import BeautifulSoup
import requests
import json
import sys

def scrape_category(url):
    try:
        response = requests.get(url)
        response.raise_for_status()
        soup = BeautifulSoup(response.content, 'html.parser')
        # Extracting section categories apps
        section_category = soup.find('footer')
        div_category = section_category.find('div', class_='tw-container')
        cat = div_category.find('div', class_='tw-grid tw-auto-rows-min')
        # List to store category information
        categories = []
        for a in cat.find_all('a'):
          # Extract category name
            category_name = a.text.strip()
            # Extract href
            category_href = a.get('href')
            # Create dictionary for category
            category = {'name': category_name, 'href': category_href}
            # Add category dictionary to list
            categories.append(category)

        return categories
    except requests.exceptions.RequestException as e:
        print("Error:", e)
        return None

if __name__ == '__main__':
    if len(sys.argv) > 1:
        url = sys.argv[1]
        result = scrape_category(url)
        if result:
            print(json.dumps(result, indent=2))
        else:
            print('Failed to scrape the website.')
