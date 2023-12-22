import requests
from bs4 import BeautifulSoup
import json
import sys

def scrape_info(url):
    response = requests.get(url)
    
    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'lxml')
        class_logo = 'tw-items-stretch'
        
        name_app = [element.text.strip() for element in soup.select('.tw-hyphens')]
        developer = [element.text.strip() for element in soup.select('.tw-border-b-2')]
        nb_avis = [element.text.strip() for element in soup.select('.tw-text-heading-4')]
        image_tags = soup.select(f'.{class_logo} img')
        liste_div = soup.find('div', class_='tw-mt-4 tw-space-y-6')
        tot_div = [a_tag for a_tag in liste_div.find_all('div')]
        tot_p=soup.find_all('p',class_='tw-text-fg-tertiary tw-text-body-sm')
        date=''
        if len(tot_div) ==4:         
             list_date=tot_p[0].text.split()
             midpoint = len(list_date) // 2
             date=' '.join(list_date[:midpoint])
        else:
            date=tot_p[0].text.replace('\n','')
        cat = soup.find_all('span', class_='tw-text-fg-tertiary tw-text-body-sm')

        list_cat_double = [a_tag.text for element in cat for a_tag in element.find_all('a')]
        list_cat =[]
        for item in list_cat_double:
           if item not in list_cat:
              list_cat.append(item)

        logo_sources = [img['src'] for img in image_tags if 'src' in img.attrs]
        
        list_cat = [item.replace('\n', '') for item in list_cat]
        info = {
            'name_app': name_app[0],
            'developer': developer[3],
            'link_logo': logo_sources[0], 
            'nombre_avis': nb_avis[3],
            'date_created':date,
            'langue': tot_p[1].text,
            'cat': list_cat
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
