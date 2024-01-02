import requests
from bs4 import BeautifulSoup
import json
from time import sleep
import sys
def scrape_tarif(url):
    response = requests.get(url)

    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'lxml')
        sleep(2)
        pricing_cards_div = soup.find('div', {'class': 'pricing-cards--desktop'})
        if pricing_cards_div :
           info_tarif = []

           tw_shadow_pricing_cards = pricing_cards_div.find_all('div', {'class': 'tw-shadow-pricingCard'})

           for list_div in tw_shadow_pricing_cards:
              name_card = list_div.find('p').text.strip()
              price_card = list_div.find('h3').text.strip()
              ul_items = list_div.find('ul')
              plans = []

              for li_element in ul_items.find_all('li'):
                  plans.append(li_element.text.strip())
                
              for i in plans:
                plans.remove("")
            
              info_tarif.append({'name': name_card, 'price': price_card, 'plans': plans})

              return info_tarif

    return None
if __name__ == '__main__':
  if len(sys.argv) > 1:
    url = sys.argv[1]
    result = scrape_tarif(url)
    if result:
        print(json.dumps(result, indent=2))
        #, indent=2
    else:
        print('Failed to scrape the website.')
