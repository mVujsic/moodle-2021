## Предмет: Софтверски инжењеринг 2 
## Тема : Moodle платформа

### Технологије:
- ***PHP5***
- ***Bootstrap***
- ***ResponsiveCSS***
- ***Apache2***
- ***MySql***
- ***JQuery***

### Рад на бази података: грана DBv2

# [Product Backlog](https://docs.google.com/spreadsheets/d/1BWF8PYiiqGY7swIPkNOL_ydehP8uunlqmWcuceMfM1Q/edit?usp=sharing)

### Комуницирамо преко Issues одсека, ту ћемо качити задатке а ви се јављајте ко ће шта да ради.
### Доле су упутства за branch-oвање.
----------------------------------------------------------------------------------------------------------
## Најпре 
1. Инсталирати git за winOS или linux са званичног сајта
2. Након инсталације подесити git командом:
```bash
git config --local user.email "your_email@example.com"
git config --local user.name "yourNickonGit"
```

# Неопходно за развијање апликације:
1. Инсталиран Wampp64:
2. Навигирати до Wampp64 инсталационог директоријума и ући у директоријум ***www***\[cmd|bash шта ко користи]
3. Направити локалну копију репозиторијума командом
``` bash
  $ git clone https://github.com/mVujsic/moodle-2021.git
```
4. Инсталирати или VSCode или PHPStorm, и у њему отворити предходно поменути директоријум.
5. Покренути Wamp сервисе.
6. На адреси localhost/moodle-2021 треба да се појави index.html.
----------------------------------------------------------------------------------------------------------
## У зависности од тога да ли радимо на новој(1) или туђој(remote) грани (2) разликујемо команде:
### 1. **Нова грана** 
```bash
cd <folder_gde_se_nalazi_projekat>
git pull  | pretpostavka da je grana master
git checkout -b <kratko_ime_grane_izborno>  | vrlo vazno, nakon ove komande radimo na projektu
git add . |sledi kad smo sigurni da smo uradili sve sto smo hteli
git commit -m "kratak_opis_sta_se_radilo"
git push -u origin <izabrano_ime_grane>
```
Nакон тога ући на сајт репозиторијума,наћи своју грану и кликнути на 
```
create pull request
```
### 2. **Рад на већ постојећој грани**
```bash
cd <folder_gde_se_nalazi_projekat>
git pull  | pretpostavka da je grana master
git branch -a | sve koje pocinju sa remotes/origin su tudje grane ostale su lokalne
```
Желимо да додамо нешто у туђу грану рецимо грану remotes/origne/DBv2

```bash
git checkout DBv2 | remote grana postaje lokalna grana
git pull
git add . |sledi kad smo sigurni da smo uradili sve sto smo hteli
git commit -m "kratak_opis_sta_se_radilo"
git push -u origin DBv2
```




