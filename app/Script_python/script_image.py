import requests
from bs4 import BeautifulSoup
from time import sleep
import sys
import json

def scrape_images(url):
# url = input('Enter the URL: ')
  response = requests.get(url)
  if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'lxml')
        class_img='gallery-component__item'
        sleep(2)
        image_tags = soup.select(f'.{class_img} img')
        video = soup.find_all('iframe', class_='tw-aspect-[16/9] lg:tw-min-h-full tw-w-full tw-rounded-sm')
        src_video = [iframe['src'] for iframe in video]
        
        image_sources = [img['src'] for img in image_tags if 'src' in img.attrs]
        if src_video :
             image_sources.insert(0,src_video[0])
        return image_sources
  return None

if __name__ == '__main__':
    
    if len(sys.argv) > 1:
      url = sys.argv[1]
      result = scrape_images(url)
      if result:
         print(json.dumps(result))
      else:
         print("No images found")