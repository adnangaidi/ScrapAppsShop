import requests
from bs4 import BeautifulSoup
import json
from time import sleep
import sys

def scrape_tarif(url):
    response = requests.get(url)

    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'html.parser')
        sleep(2)
        pricing_cards_div = soup.find('section', {'id': 'adp-pricing'})
        
        if pricing_cards_div:
            info_tarif = []
            tarif_desktop = pricing_cards_div.find('div', {'class': 'pricing-cards--desktop'})

            if tarif_desktop:
                tw_shadow_pricing_cards = tarif_desktop.find_all('div', {'class': 'tw-shadow-pricingCard'})

                for list_div in tw_shadow_pricing_cards:
                    name_card = list_div.find('p').text.strip()
                    price_card = list_div.find('h3').text.strip()

                    # Extracting plans by splitting the text using '\n'
                    plans = [item.strip() for li_element in list_div.find_all('li') for item in li_element.text.split('\n')]
                    plans = list(set(filter(None, plans)))  # Remove empty strings from the list

                    info_tarif.append({'name': name_card, 'price': price_card, 'plans': plans})

                return info_tarif
            else:
                return []

    return None

if __name__ == '__main__':
  if len(sys.argv) > 1:
    url = sys.argv[1]
    result = scrape_tarif(url)
    if result:
        print(json.dumps(result, indent=2))
    else:
        print('No pricing information available or failed to scrape the website.')
