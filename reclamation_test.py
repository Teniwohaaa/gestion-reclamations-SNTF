from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
import unittest
import os

class ReclamationTest(unittest.TestCase):
    def setUp(self):
        self.driver = webdriver.Chrome()
        self.driver.get("http://localhost/SNTF/Gl/reclamation.php")
        self.wait = WebDriverWait(self.driver, 10)

    def test_submit_reclamation(self):
        # Remplir les informations personnelles
        self.wait.until(EC.presence_of_element_located((By.NAME, "firstName"))).send_keys("Jean")
        self.driver.find_element(By.NAME, "lastName").send_keys("Dupont")
        self.driver.find_element(By.NAME, "email").send_keys("jean.dupont@test.com")
        self.driver.find_element(By.NAME, "phone").send_keys("0555123456")

        # Remplir les détails de la réclamation
        self.driver.find_element(By.NAME, "tripDate").send_keys("2023-12-25")
        self.driver.find_element(By.NAME, "trainNumber").send_keys("1234")
        self.driver.find_element(By.NAME, "departure").send_keys("Alger")
        self.driver.find_element(By.NAME, "arrival").send_keys("Oran")

        # Sélectionner le type de réclamation
        select = Select(self.driver.find_element(By.NAME, "complaintType"))
        select.select_by_value("retard")

        # Remplir la description
        self.driver.find_element(By.NAME, "description").send_keys("Test de réclamation automatisé")

        # Soumettre le formulaire
        submit_button = self.driver.find_element(
            By.XPATH, "//button[@type='submit' and @name='submit']"
        )
        submit_button.click()

        # Vérifier la redirection vers la page de suivi
        self.wait.until(EC.url_contains("suivi_reclamation.php"))

    def test_empty_form_submission(self):
        # Tenter de soumettre un formulaire vide
        submit_button = self.driver.find_element(
            By.XPATH, "//button[@type='submit' and @name='submit']"
        )
        submit_button.click()

        # Vérifier la présence des messages d'erreur de validation HTML5
        first_name_field = self.driver.find_element(By.NAME, "firstName")
        self.assertFalse(first_name_field.get_attribute("validity").get("valid"))

    def tearDown(self):
        self.driver.quit()

if __name__ == "__main__":
    unittest.main()
