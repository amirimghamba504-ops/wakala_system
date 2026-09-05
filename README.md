# Mfumo wa Wakala Mkuu na Wakala wa Kawaida
### (Money In/Out, Muamala, na Ripoti ya Faida ya Kila Siku)

Mfumo huu unamsaidia **Wakala Mkuu** kusimamia **Wakala wake wa Kawaida** (mawakala wadogo chini yake): kutoa float, kufuatilia miamala ya kuweka/kutoa pesa, kuhesabu kamisheni, na kujua **faida** ya kila siku.

---

## 1. Mahitaji
- XAMPP (Apache + MySQL/MariaDB + PHP 8.0+)
- Browser yoyote

## 2. Jinsi ya Kusanidi (Setup)

1. Nakili folda nzima `wakala_system` ndani ya `htdocs` ya XAMPP:
   `C:\xampp\htdocs\wakala_system` (Windows) au `/Applications/XAMPP/htdocs/wakala_system` (Mac)

2. Washa **Apache** na **MySQL** kwenye XAMPP Control Panel.

3. Fungua **phpMyAdmin** (`http://localhost/phpmyadmin`), bofya kichupo **Import**, chagua faili:
   `config/database.sql`
   kisha bofya **Go**. Hii itaunda database `wakala_system` pamoja na jedwali zote, viwango vya kamisheni, na akaunti ya kwanza ya Wakala Mkuu.

4. Fungua browser nenda:
   `http://localhost/wakala_system/seed_admin.php`
   (Hii inasahihisha usimbaji wa namba ya simu ya akaunti ya kwanza. Fanya hivi **mara moja tu**, kisha futa faili hilo kwa usalama.)

5. Nenda: `http://localhost/wakala_system/`
   Login na:
   - **Username:** `mkuu`
   - **Password:** `mkuu123`

   ⚠️ Badilisha nywila hii mara moja unapoanza kutumia mfumo kwa dhati (kwa sasa hakuna ukurasa wa "badilisha nywila" wa moja kwa moja — unaweza kuongeza kwa urahisi, au niambie nikuongezee).

---

## 3. Jinsi Mfumo Unavyofanya Kazi

### Majukumu (Roles)
- **Wakala Mkuu** — anasimamia mtandao mzima: anaongeza Wakala wa Kawaida, anawapa float, anakusanya cash, anaona ripoti ya faida ya mtandao mzima, na pia anaweza kufanya miamala yake mwenyewe.
- **Wakala wa Kawaida** — anafanya miamala ya wateja (kuweka/kutoa pesa), anarekodi matumizi, na anaona ripoti ya faida yake binafsi.

### Muamala (Transactions)
- **Kuweka Pesa (Deposit/Cash-In):** Mteja analeta cash, wakala anatuma float. Float ya wakala inapungua, cash ya wakala inaongezeka + kamisheni.
- **Kutoa Pesa (Withdraw/Cash-Out):** Mteja anataka cash, wakala anapokea float. Float ya wakala inaongezeka, cash inapungua + kamisheni.

### Kamisheni
Imepangwa kwa "viwango" (tiers) kwenye jedwali `commission_rates` — unaweza kubadilisha kiasi hivi moja kwa moja kupitia phpMyAdmin kulingana na makubaliano yako na kampuni ya simu/benki.

### Faida ya Siku (Daily Profit)
```
Faida = Jumla ya Kamisheni ya Siku − Jumla ya Matumizi ya Siku
```
Inaonekana kwenye ukurasa wa "Ripoti ya Faida" kwa kila wakala, na kwa Wakala Mkuu inaonekana kwa mtandao mzima pia (yeye + wakala wake wote).

---

## 4. Muundo wa Mfumo (Kwa Documentation/Ripoti ya Chuo)

```
wakala_system/
├── config/
│   ├── config.php         # Mipangilio ya database + usalama
│   └── database.sql       # Schema + seed data
├── classes/
│   ├── Database.php       # PDO singleton connection
│   ├── Encryption.php     # AES-256-CBC (namba za simu)
│   ├── Csrf.php            # Ulinzi wa CSRF
│   ├── Auth.php            # Login/logout/session guard
│   ├── User.php            # Abstract base class
│   ├── WakalaMkuu.php       # extends User
│   ├── WakalaKawaida.php    # extends User
│   ├── Transaction.php     # Deposit/Withdraw + commission engine
│   ├── Expense.php         # Matumizi ya kila siku
│   └── Report.php          # Uhesabuji wa faida
├── includes/                # header/sidebar/footer (Bootstrap 5)
├── mkuu/                    # Kurasa za Wakala Mkuu
├── kawaida/                 # Kurasa za Wakala wa Kawaida
├── assets/css/style.css
├── index.php / login.php / logout.php
└── seed_admin.php           # Futa baada ya kuitumia mara moja
```

### Usalama uliotumika
- PDO Prepared Statements (kuzuia SQL Injection)
- Password hashing na Bcrypt
- CSRF tokens kwenye fomu zote
- AES-256-CBC encryption kwa namba za simu za wateja/wakala
- Role-based access control (Wakala Mkuu vs Wakala wa Kawaida)

---

## 5. Vidokezo
- Badilisha `ENCRYPTION_KEY` kwenye `config/config.php` kabla ya kutumia kwa dhati (lazima iwe herufi 32 hasa).
- Ongeza wakala wapya kupitia ukurasa wa "Wakala wa Kawaida" (Mkuu pekee ndiye anaweza).
- Kama unataka nyongeza — mfano: ripoti ya PDF/Excel, SMS notification, au ukurasa wa "badilisha nywila" — niambie tu.
