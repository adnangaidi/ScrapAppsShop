import json
import sys
import  scrape_apps_with_pagination
import  scrape_apps_not_pagination

if __name__ == '__main__':
  if len(sys.argv) > 1:
    url = sys.argv[1]
    result=scrape_apps_with_pagination.scrape_with_pagination(url)
    if result:
      print(json.dumps(result,indent=2))
    elif result==None:
      result1=scrape_apps_not_pagination.scrape_not_pagination(url)
      if result1:
       print(json.dumps(result1,indent=2))
    else:
      print('Failed to scrape the website.')