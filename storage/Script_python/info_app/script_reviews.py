from bs4 import BeautifulSoup
import requests
import json
import sys

# Function to scrape reviews
def scrape_reviews(url):
  
    page0_url = f"{url}/reviews?locale=en"
  
    response = requests.get(page0_url)

    if response.status_code == 200:
        reviews = []

        soup = BeautifulSoup(response.text, 'html.parser')
        # Find section pagination reviews
        section_pagi = soup.find('section', class_='tw-hidden lg:tw-block')

        # Add a check for section_pagi
        if section_pagi:
            # Find number of pages of reviews
            a_tags = section_pagi.find_all('a')
        else:
            # Handle the case where section_pagi is not found
            print('Section pagination not found. Exiting...')
            return None

        nb_page = 0
        i = 0

        for a_tag in a_tags:
            i += 1
            if i == len(a_tags) - 1:
                nb_page = int(a_tag.text)

        # Find data of all reviews
        for page in range(1, nb_page + 1):
            page_url = f"{url}/reviews?page={page}&locale=en"
            response = requests.get(page_url)

            if response.status_code == 200:
                page_soup = BeautifulSoup(response.text, 'html.parser')
                # Find div of data reviews
                tree_divs = page_soup.find_all('div', {'class': 'md:tw-grid md:tw-grid-cols-[192px,1fr]'})
                for tree_div in tree_divs:
                    store = ''
                    country = ''
                    used_period = ''
                    date = ''
                    content = ''
                    date_reply = ''
                    reply = ''
                    num_start = 0
                    # Information of store
                    tree0_divs = tree_div.find_all('div', {'class': 'tw-order-2 md:tw-order-1 md:tw-row-span-2 tw-mt-md md:tw-mt-0 tw-space-y-1 md:tw-space-y-2 tw-text-fg-tertiary tw-text-body-xs'})
                    for tree1_div in tree0_divs:
                        info_store = [child.get_text(strip=True) for child in tree1_div.find_all('div')]
                        if len(info_store) >= 3:
                            store = info_store[0]
                            country = info_store[1]
                            used_period = info_store[2]
                        else:
                            store = ''
                            country = ''
                            used_period = ''

                    # Information of reviews
                    tree1_divs = tree_div.find_all('div', {'class': 'tw-order-1 md:tw-order-2 md:tw-pl-xl tw-overflow-x-auto'})
                    for tree1_div in tree1_divs:
                        info_revi = [child.get_text(strip=True) for child in tree1_div.find_all('div')]
                        info_revi.remove('')
                        date = info_revi[1]
                        content = info_revi[2].replace('Show more', '')
                        # Find number of stars
                        svg_elements = tree1_div.find_all('svg', class_='tw-fill-fg-primary tw-w-md tw-h-md')
                        if svg_elements:
                            i = 0
                            for svg_element in svg_elements:
                                path_data = svg_element.find('path')['d']
                                if 'M8 0.75C8.14001 0.74991' in path_data:
                                    num_start += 1

                    # Information of reply
                    tree2_divs = tree_div.find_all('div', {'class': 'tw-border-l tw-border-solid tw-border-fg-disabled'})
                    for tree1_div in tree2_divs:
                        # Date of reply
                        info_reply = [child.get_text(strip=True) for child in tree1_div.find('div', {'class': 'tw-text-body-xs tw-text-fg-tertiary tw-mb-sm'})]
                        info_reply_split = info_reply[0].split('\n')
                        # Content of reply
                        info_reply1 = [child.get_text(strip=True) for child in tree1_div.find('p')]
                        info_reply_split += info_reply1
                        date_reply = info_reply_split[1]
                        date_reply = date_reply.lstrip()
                        reply = info_reply_split[2]

                    info = {'num_start': num_start, 'store': store, 'contry': country, 'used_period': used_period,
                            'date': date, 'content': content, 'date_reply': date_reply, 'reply': reply}
                    reviews.append(info)
        return json.dumps(reviews,indent=2) 
    return None

# Example usage
if __name__ == '__main__':
    if len(sys.argv) > 1:
        url = sys.argv[1]
        result = scrape_reviews(url)
        if result:
            print(result)
        else:
            print('Failed to scrape the website.')

