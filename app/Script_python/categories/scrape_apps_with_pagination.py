from bs4 import BeautifulSoup
import requests


# Function to scrape reviews
def scrape_with_pagination(url):
  try:
    response = requests.get(url)
    if response.status_code == 200:
        apps = []
        soup = BeautifulSoup(response.text, 'html.parser')
        # section_pagination = soup.find('section', {'data-app-comparison-wrapper-target': 'pagination'})
        div_page = soup.find('div', {'aria-label': 'pagination'})

        if div_page:
            a_tags = div_page.find_all('a')
            nb_page = 0
            for a_tag in a_tags:
               page_text = a_tag.text.strip()
               if page_text.isdigit():
                nb_page = max(nb_page, int(page_text))
        # Find div of all data apps
            for page in range(1, nb_page + 1):
                page_url = f"{url}&page={page}"
                response1 = requests.get(page_url)
                if response1.status_code == 200:
                    page_soup = BeautifulSoup(response1.text, 'html.parser')
                    div_apps_grid = page_soup.find('turbo-frame', {'id': 'app_grid'})
                    if div_apps_grid:
                        app_grid = div_apps_grid.find_all('div', {'data-controller': "app-card"})
                        for app in app_grid:
                            href_app = app.find('a')['href']
                            apps.append(href_app)
            return apps
  except requests.exceptions.RequestException as e:
        print("Error:", e)
        return None




