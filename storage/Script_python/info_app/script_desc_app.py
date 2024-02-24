import requests
from bs4 import BeautifulSoup
import json
import sys
from time import sleep

def scrapeDescriptionApp(url):
    response = requests.get(url)
    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'lxml')
        sleep(2)
        
        app_description_section = soup.find('section', {'id': 'adp-details-section'})
        app_details = app_description_section.find('div', {'id': 'app-details'})
        title = app_details.find('h2').text.strip()
        body=app_details.find('p').text.strip()
        ul_items = app_details.find('ul').find_all('li')
        role_texts = []
        for li_element in ul_items:
          if li_element:
            #  span_element = li_element.find_all('span')
             role_texts.append(li_element.text.strip())
          else:
             span_element = li_element.find_all('span')
             role_texts.append(span_element.text.strip())
             
        res={'title': title,'body':body, 'role': role_texts}
        return res
    return None


if __name__ == '__main__':
    if len(sys.argv) > 1:   
        url = sys.argv[1]
        result = scrapeDescriptionApp(url)
        if result:
          print(json.dumps(result))
        else:
          print('Failed to scrape the website.')
