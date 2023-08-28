Post Api dla bloga

Kolejność wykonywanych zadań:

1. Dodanie obsługi api jako resource (CRUD) dla postów wraz z PostRequest i postResource.
2. Dodanie seedera wypełniającego bazę danych przykładowymi danymi dla tabeli posts.
3. Dodanie rejestracji użytkownika (bez autentyfikacji)
4. Walidacja danych przy pomocy UserRequest dla edycji użytkownika
5. Dodanie ról dla użytkownika, zabezpieczenie konkretnych metod kontrolerów odpowiednią bramą dostępu dla poszczególnych ról.
6. Wprowadzenie autentyfikacji logowania do api z wykorzystaniem tokenów sanctum
7. Dodanie obsługi rejestracji i ustawienia odpowiedniego job'a, który asynchronicznie będzie wysyłał do kolejki wysyłanie emaili po rejestracji

Dlaczego taka kolejność?
Rozpoczynam budowę aplikacji od schematu wypełniania bazy danymi, na których
następnie można przeprowadzać kolejne realizacje zadań- tj. seddery, operacje CRUD
Następnie przystępuję do budowy schematu logowania i rejestracji dla użytkowników, dostępów do powyższych operacji
Jak już użytkownicy mogą przeprowadzać logowanie i wszystkie operacje CRUD-w prowadzam odpowiednie role i blokuję dostępy do konkretnych ról.

Co zrobiłbym lepiej gdyby było więcej czasu?
Dodałbym tabelę role i drugą tabelę z dostępami dla poszczególnych operacji CRUD dla odpowiednich
ról i utworzoną relacją pobierać poziom dostępu.
Wprowadziłbym potwierdzenie rejestracji wymuszające kliknięcie w link przesłany w emailu.  
