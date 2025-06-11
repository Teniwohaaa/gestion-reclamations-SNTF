from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import unittest

class LoginTest(unittest.TestCase):
    def setUp(self):
        self.driver = webdriver.Chrome()
        self.driver.get("http://localhost/SNTF/Gl/login.php")
        self.wait = WebDriverWait(self.driver, 10)

    def test_successful_login(self):
        # Trouver et remplir le champ email
        email_field = self.wait.until(
            EC.presence_of_element_located((By.NAME, "email"))
        )
        email_field.send_keys("admin@sntf.dz")

        # Trouver et remplir le champ mot de passe
        password_field = self.driver.find_element(By.NAME, "password")
        password_field.send_keys("admin123")

        # Trouver et cliquer sur le bouton de soumission
        submit_button = self.driver.find_element(
            By.XPATH, "//button[@type='submit' and contains(@class, 'btn-primary')]"
        )
        submit_button.click()

        # Attendre la redirection et vérifier si la connexion a réussi
        # Ajuster la condition de succès en fonction du contenu de votre tableau de bord
        self.wait.until(
            EC.url_contains("admin.php")
        )

    def test_failed_login(self):
        # Tester avec des identifiants invalides
        email_field = self.wait.until(
            EC.presence_of_element_located((By.NAME, "email"))
        )
        email_field.send_keys("wrong@email.com")

        password_field = self.driver.find_element(By.NAME, "password")
        password_field.send_keys("wrongpassword")

        submit_button = self.driver.find_element(
            By.XPATH, "//button[@type='submit' and contains(@class, 'btn-primary')]"
        )
        submit_button.click()

        # Vérifier le message d'erreur
        error_message = self.wait.until(
            EC.presence_of_element_located((By.CLASS_NAME, "alert"))
        )
        self.assertIn("error", error_message.get_attribute("class"))

    def tearDown(self):
        self.driver.quit()

if __name__ == "__main__":
    unittest.main()
