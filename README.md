Goodie

Det här projektet är gjort i WordPress med WooCommerce.
Jag har använt LocalWP för att köra sidan lokalt.

Så jag satte upp projektet

1. Jag skapade en lokal sida i LocalWP.
2. Jag installerade WordPress i den lokala miljön.
3. Jag aktiverade WooCommerce.
4. Jag lade in mitt custom plugin goodie-plugin.
5. Jag aktiverade mitt theme goodie-theme.
6. Jag lade till produkter i WooCommerce som används i collections.
7. Jag skapade sidor och kopplade frontend-flödet till temat och pluginet.

Det som finns i projektet

- användare kan skapa en candy collection från frontend
- varje collection sparas som en egen post type
- collections har kategorier
- man kan se alla collections i en archive-sida
- man kan öppna en single collection-sida
- man kan lägga hela collectionen i cart
- checkout går via WooCommerce
- Stripe är installerat och fungerar för köp
- GTM och GA4 är kopplat för tracking

Så jag testade projektet

1. Jag skapade en collection från formuläret på frontend.
2. Jag kontrollerade att collectionen sparades och visades korrekt.
3. Jag testade att öppna collection-sidan.
4. Jag testade att lägga hela collectionen i cart.
5. Jag testade checkout-flödet i WooCommerce.
6. Jag kontrollerade att GTM laddades på sidan.
7. Jag testade eventet goodie_collection_created i GTM Preview och GA4 DebugView.

Lokal miljö

- LocalWP
- WordPress
- WooCommerce
- Stripe
- Google Tag Manager
- Google Analytics 4

Projektet är byggt för att köras lokalt i min LocalWP-miljö.

Om projektet ska previewas av någon annan

Om någon annan ska köra projektet behöver även WordPress-innehållet finnas, inte bara koden.

Det som behöver finnas är:

- WooCommerce aktiverat
- produkter skapade i WooCommerce
- minst en collection category
- sidorna som används i flödet
- pluginet goodie-plugin aktiverat
- temat goodie-theme aktiverat

Om bara temat och pluginet finns utan databas-innehåll så kommer produkterna och delar av flödet inte att synas direkt.