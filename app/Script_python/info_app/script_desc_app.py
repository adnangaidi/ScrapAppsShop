import requests
from bs4 import BeautifulSoup
import json
import sys
from time import sleep

def scrape_images(url):
    response = requests.get(url)
    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'lxml')
        sleep(2)
        app_details = soup.find('div', {'id': 'app-details'})
        ul_items = app_details.find('ul').find_all('li')
        title = app_details.find('h2').text.strip()
        body=app_details.find('p').text.strip()
        role_texts = []
        for li_element in ul_items:
             span_element = li_element.find_all('span')[1]
             role_texts.append(span_element.text.strip())
             
        res={'title': title,'body':body, 'role': role_texts}
        return res
    return None


if __name__ == '__main__':
    if len(sys.argv) > 1:
        url = sys.argv[1]
        result = scrape_images(url)
        if result:
          print(json.dumps(result))
        else:
          print('Failed to scrape the website.')
