from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from time import sleep


def test_xss(driver, element_id, payload):
    try:
        input_element = WebDriverWait(driver, 10).until(
            EC.presence_of_element_located((By.ID, element_id)))
        input_element.clear()
        input_element.send_keys(payload)
        input_element.send_keys(Keys.RETURN)
        sleep(4)

        if payload in driver.page_source:
            print(
                f"Possible XSS vulnerability detected in element with id '{element_id}'")
        else:
            print(
                f"No XSS vulnerability detected in element with id '{element_id}'")
    except Exception as e:
        print(f"Error testing element with id '{element_id}': {str(e)}")


if __name__ == "__main__":
    url = 'http://localhost/TechyDev/my-app/signup.php'
    payload = "<script>alert('XSS')</script>"
    # payload = "<script > window.location.href = 'https://www.google.com'  </script >"

    # Replace with the desired WebDriver, e.g., webdriver.Firefox()
    driver = webdriver.Chrome()
    driver.get(url)

    # List of form element ids to test
    element_ids = [
        'givenName',
        'middleName',
        'familyName',
        'email',
        'customGender',
        'address1',
        'address2',
        'postCode',
        'city',
        'mobileNumber',
        'password'
    ]

    for element_id in element_ids:
        test_xss(driver, element_id, payload)

    driver.quit()
