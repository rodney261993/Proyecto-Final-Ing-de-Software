#################
# Scrip to scrape PDF files 
# from https://www.researchgate.net/publication/317177787_Web_Scraping
#################

# packages 
import requests
from bs4 import BeautifulSoup 
from urllib.request import unquote 

# target 
url = 'https://www.researchgate.net/publication/317177787_Web_Scraping'

# make HTTP get request to the target URL 
response = requests.get(url)

# parse content 
content = BeautifulSoup(response.text, 'lxml')

# extraxr PDF URLs 
all_urls = content.find_all('a')

# loop over all URLs
for url in all_urls:
    # try urls containing 'href' attribute 
    try:
        # pick up only those urls containig pdf within href attribute 
        if 'pdf' in url['href']:
            # init PDF URL 
            pdf_url = ''

            # append base URL if no https available in URL 
            if 'https' not in url['href']:
                pdf_url = 'https://www.researchgate.net' + url['herf']

            # otherwise use bare URL
            else:
                pdf_url = url['href']

            # make HTTP get request to fetch PDF bytes
            pdf_response = requests.get(pdf_url)

            # extract PDF file name 
            filename = unquote(pdf_response.url).split('/')[-1].replace(' ', '_')

            # write PDF to local file 
            with open('./pdf/' + filename, 'wb') as f: 
                # write PDF to local file
                f.write(pdf_response.content)

    # skip all the other
    except:
        pass
