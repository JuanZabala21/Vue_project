from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
from time import sleep 
import os
# Var´s
driver = webdriver.Chrome()
driver.maximize_window()
delay = 1 # seconds
delay2 = delay*2
adminUser="enma2310@outlook.com"
adminPass="Leon2310"
#Utils
def update():
    sleep(delay)
    driver.find_element_by_id('e-name').clear()
    driver.find_element_by_id('e-name').send_keys("Test 3")
    driver.find_element_by_id('e-precio').clear()
    driver.find_element_by_id('e-precio').send_keys("5000")
    Select(driver.find_element_by_id('e-tipo')).select_by_visible_text('Parcela')
    driver.find_element_by_id("e-image").send_keys(os.getcwd()+"/example2.jpg")
    driver.find_element_by_id('actualizar').click()
    sleep(delay)
    driver.switch_to.alert.accept()
    sleep(delay)
#Register
sleep(delay)
driver.get("http://127.0.0.1:8000")
driver.find_element_by_id('registrarse').click()
sleep(delay)
driver.find_element_by_id('name').send_keys("Example name")
driver.find_element_by_id('email').send_keys("example@test.com")
driver.find_element_by_id('document').send_keys("v-12345678")
driver.find_element_by_id('password').send_keys("Test1234")
driver.find_element_by_id('password_confirmation').send_keys("Test1234")
sleep(delay)
driver.find_element_by_id('submit').click()
#Admin test 1
#Login
sleep(delay)
driver.find_element_by_id('ingresar').click()
sleep(delay)
driver.find_element_by_id('email').send_keys(adminUser)
driver.find_element_by_id('password').send_keys(adminPass)
driver.find_element_by_id('submit').click()
sleep(delay)
#Usuarios
driver.find_element_by_id('users').click()
sleep(delay)
while True:
    if(str(driver.find_element_by_id('tr1email').text)=="example@test.com"):
        driver.find_element_by_id('activ1').click()
        break
    elif(str(driver.find_element_by_id('tr2email').text)=="example@test.com"):
        driver.find_element_by_id('activ2').click()
        break
    elif(str(driver.find_element_by_id('tr3email').text)=="example@test.com"):
        driver.find_element_by_id('activ3').click()
        break
    else:
        driver.find_element_by_id('btnpost').click()
        sleep(delay)
sleep(delay)      
driver.find_element_by_id('logout').click()
sleep(delay)
#Not admin test 1
#Login
sleep(delay)
driver.find_element_by_id('ingresar').click()
sleep(delay)
driver.find_element_by_id('email').send_keys("example@test.com")
driver.find_element_by_id('password').send_keys("Test1234")
driver.find_element_by_id('submit').click()
sleep(delay)
#Profile
sleep(delay)
driver.find_element_by_id('password').send_keys("Test1234")
driver.find_element_by_id('password_confirmation').send_keys("Test1234")
driver.find_element_by_id('email').send_keys("example@test.com")
driver.find_element_by_id('document').send_keys("v-12345678")
driver.find_element_by_id('name').send_keys("Example name")
sleep(delay)
driver.find_element_by_id('save').click()
sleep(delay)
driver.switch_to.alert.accept()
sleep(delay)
driver.find_element_by_id("image").send_keys(os.getcwd()+"/profile.png")
sleep(delay)
driver.find_element_by_id('saveimage').click()
sleep(delay)
driver.switch_to.alert.accept()
sleep(delay)
driver.find_element_by_id('inmueble-p').click()
# Nuevo Inmueble personal
sleep(delay)
driver.find_element_by_id('addbtn').click()
sleep(delay)
driver.find_element_by_id('n-name').send_keys("TEST")
Select(driver.find_element_by_id('n-tipo')).select_by_visible_text('Casa')
Select(driver.find_element_by_id('n-ubic')).select_by_visible_text('San Diego')
driver.find_element_by_id('n-precio').clear()
driver.find_element_by_id('n-precio').send_keys("6000")
driver.find_element_by_id("image").send_keys(os.getcwd()+"/example.jpg")
driver.find_element_by_id('anadir').click()
sleep(delay)
driver.switch_to.alert.accept()
# Nuevo Inmueble personal 2
sleep(delay)
driver.find_element_by_id('addbtn').click()
sleep(delay)
driver.find_element_by_id('n-name').send_keys("TEST 2")
Select(driver.find_element_by_id('n-tipo')).select_by_visible_text('Apartamento')
Select(driver.find_element_by_id('n-ubic')).select_by_visible_text('Bejuma')
driver.find_element_by_id('n-precio').clear()
driver.find_element_by_id('n-precio').send_keys("3000")
driver.find_element_by_id("image").send_keys(os.getcwd()+"/example.jpg")
driver.find_element_by_id('anadir').click()
sleep(delay)
driver.switch_to.alert.accept()
# Editar Inmueble personal Test 2
sleep(delay)
while True:
    if(str(driver.find_element_by_id('name1').text)=="TEST 2"):
        driver.find_element_by_id('upd1').click()
        break
    elif(str(driver.find_element_by_id('name2').text)=="TEST 2"):
        driver.find_element_by_id('upd2').click()
        break
    elif(str(driver.find_element_by_id('name3').text)=="TEST 2"):
        driver.find_element_by_id('upd3').click()
        break
    else:
        driver.find_element_by_id('btnpost').click()
        sleep(delay)
update()
# Eliminar Inmueble personal Test
while True:
    if(str(driver.find_element_by_id('name1').text)=="TEST"):
        driver.find_element_by_id('alt1').click()
        break
    elif(str(driver.find_element_by_id('name2').text)=="TEST"):
        driver.find_element_by_id('alt2').click()
        break
    elif(str(driver.find_element_by_id('name3').text)=="TEST"):
        driver.find_element_by_id('alt3').click()
        break
    else:
        driver.find_element_by_id('btnpost').click()
        sleep(delay)
sleep(delay)      
driver.find_element_by_id('btndelete').click()
sleep(delay)
driver.switch_to.alert.accept()
sleep(delay)
driver.find_element_by_id('inmueble-g').click()
sleep(delay)
Select(driver.find_element_by_id('f-ubic')).select_by_visible_text('Bejuma')
sleep(delay2)
while True:
    if(str(driver.find_element_by_id('name1').text)=="Test 3"):
        break
    elif(str(driver.find_element_by_id('name2').text)=="Test 3"):
        break
    elif(str(driver.find_element_by_id('name3').text)=="Test 3"):
        break
    else:
        driver.find_element_by_id('btnpost').click()
        sleep(delay)
sleep(3)
driver.find_element_by_id('logout').click()
sleep(delay)
#Admin test 1
#Login
sleep(delay)
driver.find_element_by_id('ingresar').click()
sleep(delay)
driver.find_element_by_id('email').send_keys(adminUser)
driver.find_element_by_id('password').send_keys(adminPass)
driver.find_element_by_id('submit').click()
sleep(delay)
#charts
driver.find_element_by_id('charts').click()
sleep(delay)
#Out
assert "No results found." not in driver.page_source
