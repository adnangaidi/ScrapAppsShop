import requests
from bs4 import BeautifulSoup
import json
import sys

def scrape_info(url):
    response = requests.get(url)

    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'html.parser')

        # Extracting section info app
        section1 = soup.find('section', {'id': 'adp-hero'})

        # Extracting App Name
        app_name = section1.find('h1', class_='tw-text-body-3xl').text.strip()

        # Extractiong link logo
        link_logo = section1.find('img', class_='tw-rounded-sm tw-block tw-w-full')['src']

        # Extracting Number of Reviews
        num_reviews = section1.find('a', {'id': 'reviews-link'}).text.strip()

        # Extracting Developer Name
        developer_name = section1.find('div', class_='tw-text-body-md').text.strip()

        # Extracting section desc app
        section2 = soup.find('section', {'id': 'adp-details-section'})
        div_ele = section2.find('div', class_='tw-col-span-full md:tw-col-span-4 lg:tw-col-span-3 tw-flex tw-flex-col tw-gap-xl')

        # Check if the div is found
        if div_ele:
            div1 = div_ele.find('div', class_='tw-mt-4 tw-space-y-6')

            # Initialize variables
            result_string = ''
            data = ''
            list_cat = []

            # Iterate over all p elements and find relevant information
            for p_ele in div1.find_all('p'):
                if 'Launched' in p_ele.text:
                    data = p_ele.find_next('p').text.strip()
                    dataa = data.split()
                    # Find the index of the element containing '.'
                    dot_index = dataa.index('·') if '·' in dataa else None
                    result_list = dataa[:dot_index] if dot_index is not None else dataa
                    result_string = ' '.join(result_list)
                if 'Languages' in p_ele.text:
                    data = p_ele.find_next('p').text.strip()

            # Extracting categories
            cat = div1.find_all('span', class_='tw-text-fg-tertiary tw-text-body-sm')
            list_cat_double = [a_tag.text for element in cat for a_tag in element.find_all('a')]
        
            for item in list_cat_double:
                # Remove 'Other' from categories
                cleaned_item = item.replace('\n', '').strip()
                if 'Other' in cleaned_item:
                    cleaned_item = cleaned_item.replace(' - Other', '')
                list_cat.append(cleaned_item)

            info = {
                'name_app': app_name,
                'developer': developer_name,
                'link_logo': link_logo,
                'number_avis': num_reviews,
                'date_created': result_string,
                'langues': data,
                'categories': list_cat
            }
            return json.dumps(info)

    return None

if __name__ == '__main__':
    if len(sys.argv) > 1:
        url = sys.argv[1]
        result = scrape_info(url)
        if result:
          print(result)
    else:
        print('Failed to scrape the website.')
