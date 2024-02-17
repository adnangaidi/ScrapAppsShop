from bs4 import BeautifulSoup
import requests
import json
import sys

def scrape_subcategory(url):
    try:
        response = requests.get(url)
        response.raise_for_status()
        soup = BeautifulSoup(response.content, 'html.parser')
        # Extracting section categories apps
        section_category = soup.find('main')
        if section_category:
            div_category = section_category.find('section', {'data-waypoint-waypoint':"1"})
            if div_category:
                div_category1 = div_category.find('div', class_='tw-container')
                if div_category1:
                    cat = div_category1.find('div', class_='tw-flex tw-flex-col md:tw-flex-row tw-gap-gutter--mobile lg:tw-gap-gutter--desktop')
                    if cat:
                        ger = cat.find('div')
                        if ger:
                            div_subcar = ger.find('div', class_='tw-space-x-0.5')
                            if div_subcar:
                                # List to store category information
                                categories = []
                                for a in ger.find_all('a'):
                                    # Extract category name
                                    category_name = a.text.strip()
                                    # Extract href
                                    category_href = a.get('href')
                                    # Create dictionary for category
                                    category = {'name': category_name, 'href': category_href}
                                    # Add category dictionary to list
                                    categories.append(category)
                                return categories
                            else:
                                return None
                        else:
                           return None
                    else:
                        return None
                else:
                    return None
            else:
                return None
        else:
            return None
    except requests.exceptions.RequestException as e:
        print("Error:", e)
    return None


if __name__ == '__main__':
    if len(sys.argv) > 1:
        url = sys.argv[1]
        result = scrape_subcategory(url)
        if result:
            print(json.dumps(result, indent=2))
        else:
            print('Failed to scrape the website.')
