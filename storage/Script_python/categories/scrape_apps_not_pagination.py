from bs4 import BeautifulSoup
import requests
import json


def scrape_not_pagination(url):
  try:
    response = requests.get(url)
    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'html.parser')
        # section_parent = soup.find('section', {'data-waypoint-surface': "category"})
        div_card = soup.find_all('div', {'data-controller': "app-card"})
        apps = []
        for app in div_card:
            href_app = app.find('a')['href']
            name_app = app.find('a').text.strip()
            apps.append({'name': name_app, 'href': href_app})

        unique_apps = []
        seen_names = set()

        for app in apps:
          # Check if the name is seen before
            if app['name'] not in seen_names:
                unique_apps.append(app['href'])
                # Add the name to the set of seen names
                seen_names.add(app['name'])

        return unique_apps
  except requests.exceptions.RequestException as e:
        print("Error:", e)
        return None


