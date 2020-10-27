## Предмет: Софтверски инжењеринг 2 
## Тема : Moodle платформа

### Технологије:
- ***PHP5***
- ***Bootstrap***
- ***ResponsiveCSS***
- ***Apache2***
- ***MySql***
- ***JQuery***


## Комуницирамо преко Issues одсека, ту ћемо качити задатке а ви се јављајте ко ће шта да ради.

## Најпре 
1. Инсталирати git за winOS или linux са званичног сајта
2. Након инсталације подесити git командом:
```bash
git config --local user.email "your_email@example.com"
git config --local user.name "yourNickonGit"
```

## Неопходно за развијање апликације:
1. Инсталиран Wampp64:
2. Навигирати до Wampp64 инсталационог директоријума и ући у директоријум ***www***\[cmd|bash шта ко користи]
3. Направити локалну копију репозиторијума командом
``` bash
  $ git clone https://github.com/mVujsic/moodle-2021.git
```
4. Инсталирати или VSCode или PHPStorm, и у њему отворити предходно поменути директоријум.
5. Покренути Wamp сервисе.
6. На адреси localhost/moodle-2021 треба да се појави index.html.

## Након завршетка задатка покренути редом команде
```bash
cd <folder_gde_se_nalazi_projekat>
git pull
git checkout -b <kratko_ime_grane_izborno>  | vrlo vazno
git add .
git commit -m "kratak_opis_sta_se_radilo"
git push -u origin <izabrano_ime_grane>
```
2. ***Nакон тога ући на сајт репозиторијума и у одсеку pull,наћи своју грану и кликнути на*** 
```bash
create pull request
```


