import urllib.parse
from selenium import webdriver
from time import sleep


def test_xss_url(driver, url, payload):
    try:
        encoded_payload = urllib.parse.quote(payload)
        test_url = f"{url}?test_param={encoded_payload}"
        driver.get(test_url)
        sleep(2)

        if payload in driver.page_source:
            print(f"Possible XSS vulnerability detected in URL: {url}")
        else:
            print(f"No XSS vulnerability detected in URL: {url}")
    except Exception as e:
        print(f"Error testing URL '{url}': {str(e)}")


if __name__ == "__main__":
    payload = "<script>alert('XSS')</script>"

    # Replace with the desired WebDriver, e.g., webdriver.Firefox()
    driver = webdriver.Chrome()

    # List of URLs to test
    urls = [
        'http://localhost/TechyDev/my-app/signup.php'
    ]

    for url in urls:
        test_xss_url(driver, url, payload)

    driver.quit()
