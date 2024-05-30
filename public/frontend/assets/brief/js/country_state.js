
    $(document).ready(function(){
        // Countries
        var country_arr = {"Select Country" : "Select country","Afghanistan":"Afghanistan",
"Albania":"Albania",
"Algeria":"Algeria",
"Antigua and Barbuda":"Antigua and Barbuda",
"Argentina":"Argentina",
"Armenia":"Armenia",
"Australia":"Australia",
"Austria":"Austria",
"Azerbaijan":"Azerbaijan",
"Bahamas":"Bahamas",
"Bahrain":"Bahrain",
"Bangladesh":"Bangladesh",
"Barbados":"Barbados",
"Belarus":"Belarus",
"Belgium":"Belgium",
"Belize":"Belize",
"Benin":"Benin",
"Bhutan":"Bhutan",
"Bolivia":"Bolivia",
"Bosnia and Herzegovina":"Bosnia and Herzegovina",
"Botswana":"Botswana",
"Brazil":"Brazil",
"Brunei":"Brunei",
"Bulgaria":"Bulgaria",
"Burkina Faso":"Burkina Faso",
"Burundi":"Burundi",
"Cambodia":"Cambodia",
"Cameroon":"Cameroon",
"Canada":"Canada",
"Cape Verde":"Cape Verde",
"Central African Republic":"Central African Republic",
"Chad":"Chad",
"Chile":"Chile",
"China":"China",
"Colombi":"Colombi",
"Comoros":"Comoros",
"Congo (Brazzaville)":"Congo (Brazzaville)",
"Congo":"Congo",
"Costa Rica":"Costa Rica",
"Cote d'Ivoire":"Cote d'Ivoire",
"Croatia":"Croatia",
"Cuba":"Cuba",
"Cyprus":"Cyprus",
"Czech Republic":"Czech Republic",
"Denmark":"Denmark",
"Djibouti":"Djibouti",
"Dominica":"Dominica",
"Dominican Republic":"Dominican Republic",
"East Timor (Timor Timur)":"East Timor (Timor Timur)",
"Ecuador":"Ecuador",
"Egypt":"Egypt",
"El Salvador":"El Salvador",
"Equatorial Guinea":"Equatorial Guinea",
"Eritrea":"Eritrea",
"Estonia":"Estonia",
"Ethiopia":"Ethiopia",
"Fiji":"Fiji",
"Finland":"Finland",
"France":"France",
"Gabon":"Gabon",
"Gambia, The":"Gambia, The",
"Georgia":"Georgia",
"Germany":"Germany",
"Ghana":"Ghana",
"Greece":"Greece",
"Grenada":"Grenada",
"Guatemala":"Guatemala",
"Guinea":"Guinea",
"Guinea-Bissau":"Guinea-Bissau",
"Guyana":"Guyana",
"Haiti":"Haiti",
"Honduras":"Honduras",
"Hungary":"Hungary",
"Iceland":"Iceland",
"India":"India",
"Indonesia":"Indonesia",
"Iran":"Iran",
"Iraq":"Iraq",
"Ireland":"Ireland",
"Israel":"Israel",
"Italy":"Italy",
"Jamaica":"Jamaica",
"Japan":"Japan",
"Jordan":"Jordan",
"Kazakhstan":"Kazakhstan",
"Kenya":"Kenya",
"Kiribati":"Kiribati",
"Korea, North":"Korea, North",
"Korea, South":"Korea, South",
"Kuwait":"Kuwait",
"Kyrgyzstan":"Kyrgyzstan",
"Laos":"Laos",
"Latvia":"Latvia",
"Lebanon":"Lebanon",
"Lesotho":"Lesotho",
"Liberia":"Liberia",
"Libya":"Libya",
"Liechtenstein":"Liechtenstein",
"Lithuania":"Lithuania",
"Luxembourg":"Luxembourg",
"Macedonia":"Macedonia",
"Madagascar":"Madagascar",
"Malawi":"Malawi",
"Malaysia":"Malaysia",
"Maldives":"Maldives",
"Mali":"Mali",
"Malta":"Malta",
"Marshall Islands":"Marshall Islands",
"Mauritania":"Mauritania",
"Mauritius":"Mauritius",
"Mexico":"Mexico",
"Micronesia":"Micronesia",
"Moldova":"Moldova",
"Monaco":"Monaco",
"Mongolia":"Mongolia",
"Morocco":"Morocco",
"Mozambique":"Mozambique",
"Myanmar":"Myanmar",
"Namibia":"Namibia",
"Nauru":"Nauru",
"Nepa":"Nepa",
"Netherlands":"Netherlands",
"New Zealand":"New Zealand",
"Nicaragua":"Nicaragua",
"Niger":"Niger",
"Nigeria":"Nigeria",
"Norway":"Norway",
"Oman":"Oman",
"Pakistan":"Pakistan",
"Palau":"Palau",
"Panama":"Panama",
"Papua New Guinea":"Papua New Guinea",
"Paraguay":"Paraguay",
"Peru":"Peru",
"Philippines":"Philippines",
"Poland":"Poland",
"Portugal":"Portugal",
"Qatar":"Qatar",
"Romania":"Romania",
"Russia":"Russia",
"Rwanda":"Rwanda",
"Saint Kitts and Nevis":"Saint Kitts and Nevis",
"Saint Lucia":"Saint Lucia",
"Saint Vincent":"Saint Vincent",
"Samoa":"Samoa",
"San Marino":"San Marino",
"Sao Tome and Principe":"Sao Tome and Principe",
"Saudi Arabia":"Saudi Arabia",
"Senegal":"Senegal",
"Serbia and Montenegro":"Serbia and Montenegro",
"Seychelles":"Seychelles",
"Sierra Leone":"Sierra Leone",
"Singapore":"Singapore",
"Slovakia":"Slovakia",
"Slovenia":"Slovenia",
"Solomon Islands":"Solomon Islands",
"Somalia":"Somalia",
"South Africa":"South Africa",
"Spain":"Spain",
"Sri Lanka":"Sri Lanka",
"Sudan":"Sudan",
"Suriname":"Suriname",
"Swaziland":"Swaziland",
"Sweden":"Sweden",
"Switzerland":"Switzerland",
"Syria":"Syria",
"Taiwan":"Taiwan",
"Tajikistan":"Tajikistan",
"Tanzania":"Tanzania",
"Thailand":"Thailand",
"Togo":"Togo",
"Tonga":"Tonga",
"Trinidad and Tobago":"Trinidad and Tobago",
"Tunisia":"Tunisia",
"Turkey":"Turkey",
"Turkmenistan":"Turkmenistan",
"Tuvalu":"Tuvalu",
"Uganda":"Uganda",
"Ukraine":"Ukraine",
"United Arab Emirates":"United Arab Emirates",
"United Kingdom":"United Kingdom",
"United States":"United States",
"Uruguay":"Uruguay",
"Uzbekistan":"Uzbekistan",
"Vanuatu":"Vanuatu",
"Vatican City":"Vatican City",
"Venezuela":"Venezuela",
"Vietnam":"Vietnam",
"Yemen":"Yemen",
"Zambia":"Zambia",
"Zimbabwe":"Zimbabwe"

};

        

        // States
        var city_states = new Array();
        city_states['Algeria'] = 'Select State|Algiers|Adrar|Ain Defla|Ain Temouchent|Alger|Annaba|Batna|Bechar|Bejaia|Biskra|Blida|Bordj Bou Arreridj|Bouira|Boumerdes|Chlef|Constantine|Djelfa|El Bayadh|El Oued|El Tarf|Ghardaia|Guelma|Illizi|Jijel|Khenchela|Laghouat|Mascara|Medea|Mila|Mostaganem|\'Sila|Naama|Oran|Ouargla|Oum el Bouaghi|Relizane|Saida|Setif|Sidi Bel Abbes|Skikda|Souk Ahras|Tamanghasset|Tebessa|Tiaret|Tindouf|Tipaza|Tissemsilt|Tizi Ouzou|Tlemcen';
city_states['Angola'] = 'Select State|Luanda|Bengo|Benguela|Bie|Cabinda|Cuando Cubango|Cuanza Norte|Cuanza Sul|Cunene|Huambo|Huila|Lunda Norte|Lunda Sul|Malanje|Moxico|Namibe|Uige|Zaire';
city_states['Benin'] = 'Select State|Porto-Novo|Alibori|Atakora|Atlantique|Borgou|Collines|Couffo|Donga|Littoral|Mono|Oueme|Plateau|Zou';
city_states['Botswana'] = 'Select State|Gaborone|Central|Chobe|Francistown|Ghanzi|Kgalagadi|Kgatleng|Kweneng|Lobatse|Ngamiland|North-East|Selebi-Pikwe|South-East|Southern';
city_states['Burkina Faso'] = 'Select State|Ouagadougou|Bale|Bam|Banwa|Bazega|Bougouriba|Boulgou|Boulkiemde|Comoe|Ganzourgou|Gnagna|Gourma|Houet|Ioba|Kadiogo|Kenedougou|Komandjari|Kompienga|Kossi|Koupelogo|Kouritenga|Kourweogo|Leraba|Loroum|Mouhoun|Nahouri|Namentenga|Nayala|Naumbiel|Oubritenga|Oudalan|Passore|Poni|Samentenga|Sanguie|Seno|Sissili|Soum|Sourou|Tapoa|Tuy|Yagha|Yatenga|Ziro|Zondomo|Zoundweogo';
city_states['Burundi'] = 'Select State|Bujumbura|Bubanza|Bujumbura|Bururi|Cankuzo|Cibitoke|Gitega|Karuzi|Kayanza|Kirundo|Makamba|Muramvya|Muyinga|Mwaro|Ngozi|Rutana|Ruyigi';
city_states['Cameroon'] = 'Select State|Yaounde|Adamaoua|Centre|Est|Extreme-Nord|Littoral|Nord|Nord-Ouest|Ouest|Sud|Sud-Ouest';
city_states['Cape Verde'] = 'Select State|Praia|Boa Vista|Brava|Calheta|Maio|Mosteiros|Paul|Porto Novo|Ribeira Grande|Sal|Santa Catarina|Santa Cruz|Sao Domingos|Sao Nicolau|Sao Filipe|Sao Vicente|Tarrafal';
city_states['Central African Republic'] = 'Select State|Bangui|Bamingui-Bangoran|Basse-Kotto|Gribingui|Haute-Kotto|Haute-Sangha|Haut-Mbomou|Kemo-Gribingui|Lobaye|Mbomou|Nana-Mambere|Ombella-Mpoko|Ouaka|Ouham|Ouham-Pende|Sangha|Vakaga';
city_states['Chad'] = 'Select State|N\'Djamena|Assongha|Baguirmi|Bahr El Gazal|Bahr Koh|Batha Oriental|Batha Occidental|Biltine|Borkou|Dababa|Ennedi|Guera|Hadjer Lamis|Kabia|Kanem|Lac|Lac Iro|Logone Occidental|Logone Oriental|Mandoul|Mayo-Boneye|Mayo-Dallah|Monts de Lam|Ouaddai|Salamat|Sila|Tandjile Oriental|Tandjile Occidental|Tibesti';
city_states['Congo, Dem.'] = 'Select State|Kinshasa|Bandundu|Bas-Congo|Equateur|Kasai-Occidental|Kasai-Oriental|Katanga|Maniema|Nord-Kivu|Orientale|Sud-Kivu';
city_states['Congo, Rep.'] = 'Select State|Brazzaville|Bouenza|Cuvette|Kouilou|Lekoumou|Likouala|Niari|Plateaux|Pool|Sangha';
city_states['Djibouti'] = 'Select State|Djibouti|\'Ali Sabih|Dikhil|Obock|Tadjoura';
city_states['Egypt'] = 'Select State|Cairo|Ad Daqahliyah|Al Bahr al Ahmar|Al Buhayrah|Al Fayyum|Al Gharbiyah|Al Iskandariyah|Al Isma\'iliyah|Al Jizah|Al Minufiyah|Al Minya|Al Qahirah|Al Qalyubiyah|Al Wadi al Jadid|Ash Sharqiyah|As Suways|Aswan|Asyut|Bani Suwayf|Bur Sa\'id|Dumyat|Janub Sina\'|Kafr ash Shaykh|Matruh|Qina|Shamal Sina\'|Suhaj';
city_states['Equatorial Guinea'] = 'Select State|Malabo|Annobon|Bioko Norte|Bioko Sur|Centro Sur|Kie-Ntem|Litoral|Wele-Nzas';
city_states['Eritrea'] = 'Select State|Asmara|Central|Anelba|Southern Red Sea|Northern Red Sea|Southern|Gash-Barka';
city_states['Ethiopia'] = 'Select State|Addis Ababa|Adis Abeba (Addis Ababa)|Afar|Amara|Binshangul Gumuz|Dire Dawa|Gambela Hizboch|Hareri Hizb|Oromiya|Sumale (Somali)|Tigray|YeDebub Biheroch Bihereseboch...';
city_states['Gabon'] = 'Select State|Libreville';
city_states['Gambia'] = 'Select State|Estuaire|Haut-Ogooue|Moyen-Ogooue|Ngounie|Nyanga|Ogooue-Ivindo|Ogooue-Lolo|Ogooue-Maritime|Woleu-Ntem';
city_states['Ghana'] = 'Select State|Accra|Ashanti|Brong-Ahafo|Central|Eastern|Northern|Upper East|Upper West|Volta|Western';
city_states['Guinea'] = 'Select State|Conakry|Beyla|Boffa|Boke|Coyah|Dabola|Dalaba|Dinguiraye|Dubreka|Faranah|Forecariah|Fria|Gaoual|Gueckedou|Kankan|Kerouane|Kindia|Kissidougou|Koubia|Koundara|Kouroussa|Labe|Lelouma|Lola|Macenta|Mali|Mamou|Mandiana|Nzerekore|Pita|Siguiri|Telimele|Tougue|Yomou';
city_states['Guinea-Bissau'] = 'Select State|Bissau|Bafata|Biombo|Bolama/Bijagos|Cacheu|Gabu|Oio|Quinara|Tombali';
city_states['Kenya'] = 'Select State|Nairobi|Central|Coast|Eastern|Nairobi Area|North Eastern|Nyanza|Rift Valley|Western';
city_states['Lesotho'] = 'Select State|Maseru|Berea|Butha-Buthe|Leribe|Mafeteng|Mohales Hoek|Mokhotlong|Qacha\'s Nek|Quthing|Thaba-Tseka';
city_states['Liberia'] = 'Select State|Monrovia|Bomi|Bong|Gparbolu|Grand Bassa|Grand Cape Mount|Grand Gedeh|Grand Kru|Lofa|Margibi|Maryland|Montserrado|Nimba|River Cess|River Gee|Sinoe';
city_states['Libya'] = 'Select State|Tripoli|Ajdabiya|Al \'Aziziyah|Al Fatih|Al Jabal al Akhdar|Al Jufrah|Al Khums|Al Kufrah|An Nuqat al Khams|Ash Shati\'|Awbari|Az Zawiyah|Banghazi|Darnah|Ghadamis|Gharyan|Misratah|Murzuq|Sabha|Sawfajjin|Surt|Tarabulus|Tarhunah|Tubruq|Yafran|Zlitan';
city_states['Madagascar'] = 'Select State|Antananarivo|Antsiranana|Fianarantsoa|Mahajanga|Toamasina|Toliara';
city_states['Malawi'] = 'Select State|Lilongwe|Balaka|Blantyre|Chikwawa|Chiradzulu|Chitipa|Dedza|Dowa|Karonga|Kasungu|Likoma|Machinga (Kasupe)|Mangochi|Mchinji|Mulanje|Mwanza|Mzimba|Ntcheu|Nkhata Bay|Nkhotakota|Nsanje|Ntchisi|Phalombe|Rumphi|Salima|Thyolo|Zomba';
city_states['Mali'] = 'Select State|Bamako|Gao|Kayes|Kidal|Koulikoro|Mopti|Segou|Sikasso|Tombouctou';
city_states['Mauritania'] = 'Select State|Nouakchott|Adrar|Assaba|Brakna|Dakhlet Nouadhibou|Gorgol|Guidimaka|Hodh Ech Chargui|Hodh El Gharbi|Inchiri|Tagant|Tiris Zemmour|Trarza';
city_states['Mauritius'] = 'Select State|Port Louis|Agalega Islands|Black River|Cargados Carajos Shoals|Flacq|Grand Port|Moka|Pamplemousses|Plaines Wilhems|Riviere du Rempart|Rodrigues|Savanne';
city_states['Morocco'] = 'Select State|Rabat|Ad Dakhla (Oued Eddahab)|Agadir|Al Hoceima|Azilal|Beni Mellal|Ben Slimane|Boujdour|Boulemane|Casablanca|Chaouen|El Jadida|El Kelaa des Sraghna|Er Rachidia|Essaouira|Es Smara|Fes|Figuig|Guelmim|Ifrane|Kenitra|Khemisset|Khenifra|Khouribga|Laayoune|Larache|Marrakech|Meknes|Nador|Ouarzazate|Oujda|Safi|Settat|Sidi Kacem|Tanger|Tan-Tan|Taounate|Taroudannt|Tata|Taza|Tetouan|Tiznit';
city_states['Mozambique'] = 'Select State|Maputo|Cabo Delgado|Gaza|Inhambane|Manica|Maputo|Nampula|Niassa|Sofala|Tete|Zambezia';
city_states['Namibia'] = 'Select State|Windhoek|Caprivi|Erongo|Hardap|Karas|Khomas|Kunene|Ohangwena|Okavango|Omaheke|Omusati|Oshana|Oshikoto|Otjozondjupa';
city_states['Niger'] = 'Select State|Niamey|Agadez|Diffa|Dosso|Maradi|Tahoua|Tillaberi|Zinder';
city_states['Nigeria'] = 'Select State|Abuja|Abia|Adamawa|Akwa Ibom|Anambra|Bauchi|Bayelsa|Benue|Borno|Cross River|Delta|Ebonyi|Edo|Ekiti|Enugu|Gombe|Imo|Jigawa|Kaduna|Kano|Katsina|Kebbi|Kogi|Kwara|Lagos|Nassarawa|Niger|Ogun|Ondo|Osun|Oyo|Plateau|Rivers|Sokoto|Taraba|Yobe|Zamfara';
city_states['Rwanda'] = 'Select State|Kigali|Butare|Byumba|Cyangugu|Gikongoro|Gisenyi|Gitarama|Kibungo|Kibuye|Ruhengeri|Umutara';
city_states['Sao Tome/Principe'] = 'Select State|Sao Tome|Principe';
city_states['Senegal'] = 'Select State|Dakar|Diourbel|Fatick|Kaolack|Kolda|Louga|Matam|Saint-Louis|Tambacounda|Thies|Ziguinchor';
city_states['Seychelles'] = 'Select State|Victoria|Anse aux Pins|Anse Boileau|Anse Etoile|Anse Louis|Anse Royale|Baie Lazare|Baie Sainte Anne|Beau Vallon|Bel Air|Bel Ombre|Cascade|Glacis|Grand\' Anse (on Mahe)|Grand\' Anse (on Praslin)|La Digue|La Riviere Anglaise|Mont Buxton|Mont Fleuri|Plaisance|Pointe La Rue|Port Glaud|Saint Louis|Takamaka';
city_states['Sierra Leone'] = 'Select State|Freetown|Eastern|Northern|Southern|Western';
city_states['Somalia'] = 'Select State|Mogadishu|Awdal|Bakool|Banaadir|Bari|Bay|Galguduud|Gedo|Hiiraan|Jubbada Dhexe|Jubbada Hoose|Mudug|Nugaal|Sanaag|Shabeellaha Dhexe|Shabeellaha Hoose|Sool|Togdheer|Woqooyi Galbeed';
city_states['South Africa'] = 'Select State|Pretoria|Eastern Cape|Free State|Gauteng|KwaZulu-Natal|Mpumalanga|North-West|Northern Cape|Northern Province/Limpopo|Western Cape';
city_states['Sudan'] = 'Select State|Khartoum|A\'ali an Nil|Al Bahr al Ahmar|Al Buhayrat|Al Jazirah|Al Khartum|Al Qadarif|Al Wahdah|An Nil al Abyad|An Nil al Azraq|Ash Shamaliyah|Bahr al Jabal|Gharb al Istiwa\'iyah|Gharb Bahr al Ghazal|Gharb Darfur|Gharb Kurdufan|Janub Darfur|Janub Kurdufan|Junqali|Kassala|Nahr an Nil|Shamal Bahr al Ghazal|Shamal Darfur|Shamal Kurdufan|Sharq al Istiwa\'iyah|Sinnar|Warab';
city_states['Swaziland'] = 'Select State|Lobamba/Mbabane|Hhohho|Lubombo|Manzini|Shiselweni';
city_states['Tanzania'] = 'Select State|Dodoma|Arusha|Dar es Salaam|Iringa|Kagera|Kigoma|Kilimanjaro|Lindi|Mara|Mbeya|Morogoro|Mtwara|Mwanza|Pemba North|Pemba South|Pwani|Rukwa|Ruvuma|Shinyanga|Singida|Tabora|Tanga|Zanzibar Central/South|Zanzibar North|Zanzibar Urban/West';
city_states['Togo'] = 'Select State|Lome|De La Kara|Des Plateaux|Des Savanes|Centrale|Maritime';
city_states['Tunisia'] = 'Select State|Tunis|Ariana|Beja|Ben Arous|Bizerte|El Kef|Gabes|Gafsa|Jendouba|Kairouan|Kasserine|Kebili|Mahdia|Medenine|Monastir|Nabeul|Sfax|Sidi Bou Zid|Siliana|Sousse|Tataouine|Tozeur|Zaghouan';
city_states['Uganda'] = 'Select State|Kampala|Adjumani|Apac|Arua|Bugiri|Bundibugyo|Bushenyi|Busia|Gulu|Hoima|Iganga|Jinja|Kabale|Kabarole|Kaberamaido|Kalangala|Kamuli|Kamwenge|Kanungu|Kapchorwa|Kasese|Katakwi|Kayunga|Kibale|Kiboga|Kisoro|Kitgum|Kotido|Kumi|Kyenjojo|Lira|Luwero|Masaka|Masindi|Mayngc|Mbale|Mbarara|Moroto|Moyo|Mpigi|Mubende|Mukono|Nakapiripiti|Nakasongola|Nebbi|Ntungamo|Pader|Pallisa|Rakai|Rukungiri|Sembabule|Sironko|Soroti|Tororo|Wakiso|Yumbe';
city_states['Zambia'] = 'Select State|Lusaka|Central|Copperbelt|Eastern|Luapula|Lusaka|Northern|North-Western|Southern|Western';
city_states['Zimbabwe'] = 'Select State|Harare|Bulawayo|Manicaland|Mashonaland Central|Mashonaland East|Mashonaland West|Masvingo|Matabeleland North|Matabeleland South|Midlands';


//Asia
city_states['Bangladesh'] = 'Select State|Dhaka|Barisal|Chittagong|Khulna|Rajshahi|Sylhet';
city_states['Bhutan'] = 'Select State|Thimphu|Bumthang|Chhukha|Chirang|Dagana|Gasa|Geylegphug|Ha|Lhuntshi|Mongar|Paro|Pemagatsel|Punakha|Samchi|Samdrup Jongkhar|Shemgang|Tashigang|Tongsa|Wangdi Phodrang|Yangtse';
city_states['Brunei'] = 'Select State|Bandar Seri Begawan|Belait|Brunei/Muara|Temburong|Tutong';
city_states['Burma (Myanmar)'] = 'Select State|Rangoon|Ayeyarwady|Bago|Chin|Kachin|Kayin|Kayah|Magway|Mandalay|Mon|Rakhine|Sagaing|Shan|Tanintharyi|Yangon';
city_states['Cambodia'] = 'Select State|Phnom Penh|Banteay Mean Cheay|Batdambang|Kampong Cham|Kampong Chhnang|Kampong Spoe|Kampong Thum|Kampot|Kandal|Kaoh Kong|Keb|Kracheh|Mondol Kiri|Otdar Mean Cheay|Pailin|Pouthisat|Preah Seihanu (Sihanoukville)|Preah Vihear|Prey Veng|Rotanah Kiri|Siem Reab|Stoeng Treng|Svay Rieng|Takev';
city_states['China'] = 'Select State|Beijing|Anhui|Chongqing|Fujian|Gansu|Guangdong|Guangxi|Guizhou|Hainan|Hebei|Heilongjiang|Henan|Hubei|Hunan|Jiangsu|Jiangxi|Jilin|Liaoning|Nei Mongol|Ningxia|Qinghai|Shaanxi|Shandong|Shanghai|Shanxi|Sichuan|Tianjin|Xinjiang|Xizang (Tibet)|Yunnan|Zhejiang';
city_states['East Timor'] = 'Select State|Dili|Aileu|Ainaro|Baucau|Bobonaro (Maliana)|Cova-Lima (Suai)|Ermera|Lautem (Los Palos)|Liquica|Manatuto|Manufahi (Same)|Oecussi (Ambeno)|Viqueque';
city_states['India'] = 'Select State|New Delhi|Andaman/Nicobar Islands|Andhra Pradesh|Arunachal Pradesh|Assam|Bihar|Chandigarh|Chhattisgarh|Dadra/Nagar Haveli|Daman/Diu|Goa|Gujarat|Haryana|Himachal Pradesh|Jammu/Kashmir|Jharkhand|Karnataka|Kerala|Lakshadweep|Madhya Pradesh|Maharashtra|Manipur|Meghalaya|Mizoram|Nagaland|Orissa|Pondicherry|Punjab|Rajasthan|Sikkim|Tamil Nadu|Tripura|Uttaranchal|Uttar Pradesh|West Bengal';
city_states['Indonesia'] = 'Select State|Jakarta|Aceh|Bali|Banten|Bengkulu|Gorontalo|Jakarta Raya|Jambi|Jawa Barat|Jawa Tengah|Jawa Timur|Kalimantan Barat|Kalimantan Selatan|Kalimantan Tengah|Kalimantan Timur|Kepulauan Bangka Belitung|Lampung|Maluku|Maluku Utara|Nusa Tenggara Barat|Nusa Tenggara Timur|Papua|Riau|Sulawesi Selatan|Sulawesi Tengah|Sulawesi Tenggara|Sulawesi Utara|Sumatera Barat|Sumatera Selatan|Sumatera Utara|Yogyakarta';
city_states['Japan'] = 'Select State|Tokyo|Aichi|Akita|Aomori|Chiba|Ehime|Fukui|Fukuoka|Fukushima|Gifu|Gumma|Hiroshima|Hokkaido|Hyogo|Ibaraki|Ishikawa|Iwate|Kagawa|Kagoshima|Kanagawa|Kochi|Kumamoto|Kyoto|Mie|Miyagi|Miyazaki|Nagano|Nagasaki|Nara|Niigata|Oita|Okayama|Okinawa|Osaka|Saga|Saitama|Shiga|Shimane|Shizuoka|Tochigi|Tokushima|Tokyo|Tottori|Toyama|Wakayama|Yamagata|Yamaguchi|Yamanashi';
city_states['Kazakhstan'] = 'Select State|Astana|Almaty|Almaty|Aqmola|Aqtobe|Astana|Atyrau|Batys Qazaqstan|Bayqongyr|Mangghystau|Ongtustik Qazaqstan|Pavlodar|Qaraghandy|Qostanay|Qyzylorda|Shyghys Qazaqstan|Soltustik Qazaqstan|Zhambyl';
city_states['Korea, North'] = 'Select State|P\'yongyang|Chagang-do|Hamgyong-bukto|Hamgyong-namdo|Hwanghae-bukto|Hwanghae-namdo|Kaesong-si|Kangwon-do|Najin Sonbong-si|Namp\'o-si|P\'yongan-bukto|P\'yongan-namdo|P\'yongyang-si|Yanggang-do';
city_states['Korea, South'] = 'Select State|Seoul|Cheju-do|Cholla-bukto|Cholla-namdo|Ch\'ungch\'ong-bukto|Ch\'ungch\'ong-namdo|Inch\'on-gwangyoksi|Kangwon-do|Kwangju-gwangyoksi|Kyonggi-do|Kyongsang-bukto|Kyongsang-namdo|Pusan-gwangyoksi|Soul-t\'ukpyolsi|Taegu-gwangyoksi|Taejon-gwangyoksi|Ulsan-gwangyoksi';
city_states['Laos'] = 'Select State|Vientiane|Attapu|Bokeo|Bolikhamxai|Champasak|Houaphan|Khammouan|Louangnamtha|Louangphabang|Oudomxai|Phongsali|Salavan|Savannakhet|Viangchan|Viangchan|Xaignabouli|Xaisomboun|Xekong|Xiangkhoang';
city_states['Malaysia'] = 'Select State|Kuala Lumpur|Johor|Kedah|Kelantan|Labuan|Melaka|Negeri Sembilan|Pahang|Perak|Perlis|Pulau Pinang|Putrajaya|Sabah|Sarawak|Selangor|Terengganu|Wilayah Persekutuan';
city_states['Maldives'] = 'Select State|Maale|Alifu|Baa|Dhaalu|Faafu|Gaafu Alifu|Gaafu Dhaalu|Gnaviyani|Haa Alifu|Haa Dhaalu|Kaafu|Laamu|Lhaviyani|Meemu|Noonu|Raa|Seenu|Shaviyani|Thaa|Vaavu';
city_states['Mongolia'] = 'Select State|Ulaanbaatar|Arhangay|Bayanhongor|Bayan-Olgiy|Bulgan|Darhan Uul|Dornod|Dornogovi|Dundgovi|Dzavhan|Govi-Altay|Govi-Sumber|Hentiy|Hovd|Hovsgol|Omnogovi|Orhon|Ovorhangay|Selenge|Suhbaatar|Tov|Uvs';
city_states['Nepal'] = 'Select State|Kathmandu|Bagmati|Bheri|Dhawalagiri|Gandaki|Janakpur|Karnali|Kosi|Lumbini|Mahakali|Mechi|Narayani|Rapti|Sagarmatha|Seti';
city_states['Philippines'] = 'Select State|Manila|Oriental|North Cotabato|Northern Samar|Nueva Ecija|Nueva Vizcaya|Olongapo|Ormoc|Oroquieta|Ozamis|Pagadian|Palawan|Palayan|Pampanga|Pangasinan|Pasay|Puerto Princesa|Quezon|Quezon City|Quirino|Rizal|Romblon|Roxas|Samar|San Carlos (Negros Occidental)|San Carlos (Pangasinan)|San Jose|San Pablo|Silay|Siquijor|Sorsogon|South Cotabato|Southern Leyte|Sultan Kudarat|Sulu|Surigao|Surigao del Norte|Surigao del Sur|Tacloban|Tagaytay|Tagbilaran|Tangub|Tarlac|Tawi-Tawi|Toledo|Trece Martires|Zambales|Zamboanga|Zamboanga del Norte|Zamboanga del Sur';
city_states['Russia'] = 'Select State|Moskva (Moscow)|Adygeya (Maykop)|Aginskiy Buryatskiy (Aginskoye)|Altay (Gorno-Altaysk)|Altayskiy (Barnaul)|Amurskaya (Blagoveshchensk)|Arkhangel\'skaya|Astrakhanskaya|Bashkortostan (Ufa)|Belgorodskaya|Bryanskaya|Buryatiya (Ulan-Ude)|Chechnya (Groznyy)|Chelyabinskaya|Chitinskaya|Chukotskiy (Anadyr\'|Chuvashiya (Cheboksary)|Dagestan (Makhachkala)|Evenkiyskiy (Tura)|Ingushetiya (Nazran\')|Irkutskaya|Ivanovskaya|Kabardino-Balkariya (Nal\'chik)|Kaliningradskaya|Kalmykiya (Elista)|Kaluzhskaya|Kamchatskaya (Petropavlovsk-Kamchatskiy)|Karachayevo-Cherkesiya (Cherkessk)|Kareliya (Petrozavodsk)|Kemerovskaya|Khabarovskiy|Khakasiya (Abakan)|Khanty-Mansiyskiy (Khanty-Mansiysk)|Kirovskaya|Komi (Syktyvkar)|Koryakskiy (Palana)|Kostromskaya|Krasnodarskiy|Krasnoyarskiy|Kurganskaya|Kurskaya|Leningradskaya|Lipetskaya|Magadanskaya|Mariy-El (Yoshkar-Ola)|Mordoviya (Saransk)|Moskovskaya|Murmanskaya|Nenetskiy (Nar\'yan-Mar)|Nizhegorodskaya|Novgorodskaya|Novosibirskaya|Omskaya|Orenburgskaya|Orlovskaya (Orel)|Penzenskaya|Permskaya|Komi-Permyatskiy (Kudymkar)|Primorskiy (Vladivostok)|Pskovskaya|Rostovskaya|Ryazanskaya|Sakha (Yakutiya)|Sakhalinskaya (Yuzhno-Sakhalinsk)|Samarskaya|Sankt-Peterburg (Saint Petersburg)|Saratovskaya|Severnaya Osetiya-Alaniya [North Ossetia] (Vladikavkaz)|Smolenskaya|Stavropol\'skiy|Sverdlovskaya (Yekaterinburg)|Tambovskaya|Tatarstan (Kazan\')|Taymyrskiy (Dudinka)|Tomskaya|Tul\'skaya|Tverskaya|Tyumenskaya|Tyva (Kyzyl)|Udmurtiya (Izhevsk)|Ul\'yanovskaya|Ust\'-Ordynskiy Buryatskiy (Ust\'-Ordynskiy)|Vladimirskaya|Volgogradskaya|Vologodskaya|Voronezhskaya|Yamalo-Nenetskiy (Salekhard)|Yaroslavskaya|Yevreyskaya';
city_states['Singapore'] = 'Select State';
city_states['Sri Lanka'] = 'Select State|Colombo|Central|North Central|Northern|Eastern|North Western|Sabaragamuwa|Southern|Uva|Western';
city_states['Taiwan'] = 'Select State|Taipei|Chang-hua|Chia-i|Chi-lung|Chung-hsing-hsin-ts\'un|Hsin-chu|Hua-lien|I-lan|Kao-hsiung|Miao-li|Nan-t\'ou|P\'eng-hu|P\'ing-tung|T\'ai-chung|T\'ai-nan|T\'ai-pei|T\'ai-tung|T\'ao-yuan/Yun-lin';
city_states['Thailand'] = 'Select State|Bangkok|Amnat Charoen|Ang Thong|Buriram|Chachoengsao|Chai Nat|Chaiyaphum|Chanthaburi|Chiang Mai|Chiang Rai|Chon Buri|Chumphon|Kalasin|Kamphaeng Phet|Kanchanaburi|Khon Kaen|Krabi|Lampang|Lamphun|Loei|Lop Buri|Mae Hong Son|Maha Sarakham|Mukdahan|Nakhon Nayok|Nakhon Pathom|Nakhon Phanom|Nakhon Ratchasima|Nakhon Sawan|Nakhon Si Thammarat|Nan|Narathiwat|Nong Bua Lamphu|Nong Khai|Nonthaburi|Pathum Thani|Pattani|Phangnga|Phatthalung|Phayao|Phetchabun|Phetchaburi|Phichit|Phitsanulok|Phra Nakhon Si Ayutthaya|Phrae|Phuket|Prachin Buri|Prachuap Khiri Khan|Ranong|Ratchaburi|Rayong|Roi Et|Sa Kaeo|Sakon Nakhon|Samut Prakan|Samut Sakhon|Samut Songkhram|Sara Buri|Satun|Sing';
city_states['Vietnam'] = 'Select State|Hanoi|An Giang|Bac Giang|Bac Kan|Bac Lieu|Bac Ninh|Ba Ria-Vung Tau|Ben Tre|Binh Dinh|Binh Duong|Binh Phuoc|Binh Thuan|Ca Mau|Can Tho|Cao Bang|Dac Lak|Da Nang|Dong Nai|Dong Thap|Gia Lai|Ha Giang|Hai Duong|Hai Phong|Ha Nam|Ha Noi|Ha Tay|Ha Tinh|Hoa Binh|Ho Chi Minh|Hung Yen|Khanh Hoa|Kien Giang|Kon Tum|Lai Chau|Lam Dong|Lang Son|Lao Cai|Long An|Nam Dinh|Nghe An|Ninh Binh|Ninh Thuan|Phu Tho|Phu Yen|Quang Binh|Quang Nam|Quang Ngai|Quang Ninh|Quang Tri|Soc Trang|Son La|Tay Ninh|Thai Binh|Thai Nguyen|Thanh Hoa|Thua Thien-Hue|Tien Giang|Tra Vinh|Tuyen Quang|Vinh Long|Vinh Phuc|Yen Bai';


//Australia-Oceania
city_states['Australia'] = 'Select State|Canberra|Australian Capital Territory|New South Wales|Northern Territory|Queensland|South Australia|Tasmania|Victoria|Western Australia';
city_states['Fiji'] = 'Select State|Suva|Central|Eastern|Northern|Rotuma|Western';
city_states['Kiribati'] = 'Select State|Tarawa|Abaiang|Abemama|Aranuka|Arorae|Banaba|Beru|Butaritari|Gilberts (Central)|Gilberts (Northern)|Gilberts (Southern)|Kanton|Kiritimati|Kuria|Line Islands|Maiana|Makin|Marakei|Nikunau|Nonouti|Onotoa|Phoenix Islands|Tabiteuea|Tabuaeran|Tamana|Teraina';
city_states['Micronesia'] = 'Select State|Palikir|Chuuk (Truk)|Kosrae|Pohnpei|Yap';
city_states['Nauru'] = 'Select State|Yaren|Aiwo|Anabar|Anetan|Anibare|Baiti|Boe|Buada|Denigomodu|Ewa|Ijuw|Meneng|Nibok|Uaboe';
city_states['New Zealand'] = 'Select State|Wellington|Akaroa|Amuri|Ashburton|Auckland|Banks Peninsula|Bay of Islands|Bay of Plenty|Bruce|Buller|Canterbury|Carterton|Chatham Islands|Cheviot|Christchurch|Clifton|Clutha|Cook|Dannevirke|Dunedin|Egmont|Eketahuna|Ellesmere|Eltham|Eyre|Far North|Featherston|Franklin|Gisborne|Golden Bay|Gore|Great Barrier Island|Grey|Hamilton|Hastings|Hauraki Plains|Hawera|Hawke\'s Bay|Heathcote|Hikurangi|Hobson|Hokianga|Horowhenua|Hurunui|Hutt|Inangahua|Inglewood|Invercargill|Kaikoura|Kaipara|Kairanga|Kapiti Coast|Kawerau|Kiwitea|Lake|Mackenzie|Malvern|Manaia|Manawatu|Mangonui|Maniototo|Manukau|Marlborough|Masterton|Matamata|Matamata Piako|Mount Herbert|Napier|Nelson|Nelson|New Plymouth|Northland|North Shore|Ohinemuri|Opotiki|Oroua|Otago|Otamatea|Otorohanga|Oxford|Palmerston North|Pahiatua|Papakura|Paparua|Patea|Piako|Pohangina|Porirua|Queenstown Lakes|Raglan|Rangiora|Rangitikei|Rodney|Rotorua|Ruapehu|Runanga|Saint Kilda|Selwyn|Silverpeaks|Southland|South Taranaki|South Waikato|South Wairarapa|Stewart Island|Stratford|Strathallan|Taranaki|Tararua|Tasman|Taumarunui|Taupo|Tauranga|Thames Coromandel|Timaru|Tuapeka|Upper Hutt|Vincent|Waiapu|Waiheke|Waihemo|Waikato|Waikohu|Waimairi|Waimarino|Waimate|Waimate West|Waimea|Waipa|Waipawa|Waipukurau|Wairarapa South|Wairewa|Wairoa|Waitakere|Waitaki|Waitomo|Waitotara|Wallace|Wanganui|Wanganui-Manawatu|Waverley|West Coast|Western Bay of Plenty|Westland|Whakatane|Whangarei|Whangaroa|Woodville';
city_states['Palau'] = 'Select State|Koror|Aimeliik|Airai|Angaur|Hatobohei|Kayangel|Melekeok|Ngaraard|Ngarchelong|Ngardmau|Ngatpang|Ngchesar|Ngeremlengui|Ngiwal|Peleliu|Sonsoral';
city_states['Papua New Guinea'] = 'Select State|Port Moresby|Bougainville|Central|Chimbu|Eastern Highlands|East New Britain|East Sepik|Enga|Gulf|Madang|Manus|Milne Bay|Morobe|National Capital|New Ireland|Northern|Sandaun|Southern Highlands|Western|Western Highlands|West New Britain';
city_states['Samoa'] = 'Select State|Apia|A\'ana|Aiga-i-le-Tai|Atua|Fa\'asaleleaga|Gaga\'emauga|Gagaifomauga|Palauli|Satupa\'itea|Tuamasaga|Va\'a-o-Fonoti|Vaisigano';
city_states['Tonga'] = 'Select State|Nuku\'alofa|Ha\'apai|Tongatapu|Vava\'u';
city_states['Tuvalu'] = 'Select State|Fongafale';
city_states['Vanuatu'] = 'Select State|Port-Vila|Malampa|Penama|Sanma|Shefa|Tafea|Torba';


//Caribbean
city_states['Anguilla'] = 'Select State|The Valley';
city_states['Antigua/Barbuda'] = 'Select State|Saint John|Barbuda|Redonda|Saint George|Saint Mary|Saint Paul|Saint Peter|Saint Philip';
city_states['Aruba'] = 'Select State|Oranjestad';
city_states['Bahamas'] = 'Select State|Nassau|Acklins/Crooked Islands|Bimini|Cat Island|Exuma|Freeport|Fresh Creek|Governor\'s Harbour|Green Turtle Cay|Harbour Island|High Rock|Inagua|Kemps Bay|Long Island|Marsh Harbour|Mayaguana|New Providence|Nichollstown/Berry Islands|Ragged Island|Rock Sound|Sandy Point|San Salvador/Rum Cay';
city_states['Barbados'] = 'Select State|Bridgetown|Christ Church|Saint Andrew|Saint George|Saint James|Saint John|Saint Joseph|Saint Lucy|Saint Michael|Saint Peter|Saint Philip|Saint Thomas';
city_states['Cuba'] = 'Select State|Havana|Camaguey|Ciego de Avila|Cienfuegos|Ciudad de La Habana|Granma|Guantanamo|Holguin|Isla de la Juventud|La Habana|Las Tunas|Matanzas|Pinar del Rio|Sancti Spiritus|Santiago de Cuba|Villa Clara';
city_states['Dominica'] = 'Select State|Roseau|Saint Andrew|Saint David|Saint George|Saint John|Saint Joseph|Saint Luke|Saint Mark|Saint Patrick|Saint Paul|Saint Peter';
city_states['Dominican Republic'] = 'Select State|Santo Domingo|Azua|Baoruco|Barahona|Dajabon|Distrito Nacional|Duarte|Elias Pina|El Seibo|Espaillat|Hato Mayor|Independencia|La Altagracia|La Romana|La Vega|Maria Trinidad Sanchez|Monsenor Nouel|Monte Cristi|Monte Plata|Pedernales|Peravia|Puerto Plata|Salcedo|Samana|Sanchez Ramirez|San Cristobal|San Juan|San Pedro de Macoris|Santiago|Santiago Rodriguez|Valverde';
city_states['Grenada'] = 'Select State|Saint George\'s|Carriacou/Petit Martinique|Saint Andrew|Saint David|Saint John|Saint Mark|Saint Patrick';
city_states['Guadeloupe'] = 'Select State|Basse-Terre';
city_states['Haiti'] = 'Select State|Port-au-Prince|Artibonite|Centre|Grand \'Anse|Nord|Nord-Est|Nord-Ouest|Ouest|Sud|Sud-Est';
city_states['Jamaica'] = 'Select State|Kingston|Clarendon|Hanover|Manchester|Portland|Saint Andrew|Saint Ann|Saint Catherine|Saint Elizabeth|Saint James|Saint Mary|Saint Thomas|Trelawny|Westmoreland';
city_states['Martinique'] = 'Select State|Fort-de-France';
city_states['Montserrat'] = 'Select State|Brades Estate|Plymouth|Saint Anthony|Saint Georges|Saint Peter';
city_states['Netherlands Antilles'] = 'Select State|Willemstad';
city_states['Puerto Rico'] = 'Select State|San Juan|Adjuntas|Aguada|Aguadilla|Aguas Buenas|Aibonito|Anasco|Arecibo|Arroyo|Barceloneta|Barranquitas|Bayamon|Cabo Rojo|Caguas|Camuy|Canovanas|Carolina|Catano|Cayey|Ceiba|Ciales|Cidra|Coamo|Comerio|Corozal|Culebra|Dorado|Fajardo|Florida|Guanica|Guayama|Guayanilla|Guaynabo|Gurabo|Hatillo|Hormigueros|Humacao|Isabela|Jayuya|Juana Diaz|Juncos|Lajas|Lares|Las Marias|Las Piedras|Loiza|Luquillo|Manati|Maricao|Maunabo|Mayaguez|Moca|Morovis|Naguabo|Naranjito|Orocovis|Patillas|Penuelas|Ponce|Quebradillas|Rincon|Rio Grande|Sabana Grande|Salinas|San German|San Lorenzo|San Sebastian|Santa Isabel|Toa Alta|Toa Baja|Trujillo Alto|Utuado|Vega Alta|Vega Baja|Vieques|Villalba|Yabucoa|Yauco';
city_states['St. Barts'] = 'Select State';
city_states['St. Kitts/Nevis'] = 'Select State|Basseterre|Christ Church Nichola Town|St. Anne Sandy Point|St. George Basseterre|St. George Gingerland|St. James Windward|St. John Capesterre|St. John Figtree|St. Mary Cayon|St. Paul Capesterre|St. Paul Charlestown|St. Peter Basseterre|St. Thomas Lowland|St. Thomas Middle Island|Trinity Palmetto Point';
city_states['St. Lucia'] = 'Select State|Castries|Anse-la-Raye|Castries|Choiseul|Dauphin|Dennery|Gros-Islet|Laborie|Micoud|Praslin|Soufriere|Vieux-Fort';
city_states['St. Martin/Sint Maarten'] = 'Select State';
city_states['St Vincent/Grenadines'] = 'Select State|Kingstown|Charlotte|Grenadines|Saint Andrew|Saint David|Saint George|Saint Patrick';
city_states['San Andres'] = 'Select State';
city_states['Trinidad/Tobago'] = 'Select State|Port-of-Spain|Arima|Caroni|Mayaro|Nariva|Saint Andrew|Saint David|Saint George|Saint Patrick|San Fernando|Tobago|Victoria';
city_states['Turks/Caicos'] = 'Select State|Grand Turk (Cockburn Town)';


//Central America
city_states['Belize'] = 'Select State|Belmopan|Belize|Cayo|Corozal|Orange Walk|Stann Creek|Toledo';
city_states['Costa Rica'] = 'Select State|San Jose|Alajuela|Cartago|Guanacaste|Heredia|Limon|Puntarenas';
city_states['El Salvador'] = 'Select State|San Salvador|Ahuachapan|Cabanas|Chalatenango|Cuscatlan|La Libertad|La Paz|La Union|Morazan|San Miguel|Santa Ana|San Vicente|Sonsonate|Usulutan';
city_states['Guatemala'] = 'Select State|Guatemala|Alta Verapaz|Baja Verapaz|Chimaltenango|Chiquimula|El Progreso|Escuintla|Guatemala|Huehuetenango|Izabal|Jalapa|Jutiapa|Peten|Quetzaltenango|Quiche|Retalhuleu|Sacatepequez|San Marcos|Santa Rosa|Solola|Suchitepequez|Totonicapan|Zacapa';
city_states['Honduras'] = 'Select State|Tegucigalpa|Atlantida|Choluteca|Colon|Comayagua|Copan|Cortes|El Paraiso|Francisco Morazan|Gracias a Dios|Intibuca|Islas de la Bahia|La Paz|Lempira|Ocotepeque|Olancho|Santa Barbara|Valle|Yoro';
city_states['Nicaragua'] = 'Select State|Managua|Boaco|Carazo|Chinandega|Chontales|Esteli|Granada|Jinotega|Leon|Madriz|Managua|Masaya|Matagalpa|Nueva Segovia|Rio San Juan|Rivas|Atlantico Norte|Atlantico Sur';
city_states['Panama'] = 'Select State|Panama|Bocas del Toro|Chiriqui|Cocle|Colon|Darien|Herrera|Los Santos|San Blas|Veraguas';


//Europe
city_states['Albania'] = 'Select State|Tirana|Berat|Bulqize|Delvine|Devoll|Diber|Durres|Elbasan|Fier|Gjirokaster|Gramsh|Has|Kavaje|Kolonje|Korce|Kruje|Kucove|Kukes|Kurbin|Lezhe|Librazhd|Lushnje|Malesi e Madhe|Mallakaster|Mat|Mirdite|Peqin|Permet|Pogradec|Puke|Sarande|Shkoder|Skrapar|Tepelene|Tirane|Tropoje|Vlore';
city_states['Andorra'] = 'Select State|Andorra la Vella|Canillo|Encamp|La Massana|Escaldes-Engordany|Ordino|Sant Julia de Loria';
city_states['Austria'] = 'Select State|Vienna|Burgenland|Kaernten|Niederoesterreich|Oberoesterreich|Salzburg|Steiermark|Tirol|Vorarlberg|Wien';
city_states['Belarus'] = 'Select State|Minsk|Brest|Homyel\'|Horad Minsk|Hrodna|Mahilyow|Vitsyebsk';
city_states['Belgium'] = 'Select State|Brussels|Antwerpen|Brabant Wallon|Brussels (Bruxelles)|Hainaut|Liege|Limburg|Luxembourg|Namur|Oost-Vlaanderen|Vlaams-Brabant|West-Vlaanderen';
city_states['Bosnia and Herzegovina'] = 'Select State|Sarajevo';
city_states['Bulgaria'] = 'Select State|Sofiya|Blagoevgrad|Burgas|Dobrich|Gabrovo|Khaskovo|Kurdzhali|Kyustendil|Lovech|Montana|Pazardzhik|Pernik|Pleven|Plovdiv|Razgrad|Ruse|Shumen|Silistra|Sliven|Smolyan|Sofiya-Grad|Stara Zagora|Turgovishte|Varna|Veliko Turnovo|Vidin|Vratsa|Yambol';
city_states['Croatia'] = 'Select State|Zagreb|Bjelovarsko-Bilogorska|Brodsko-Posavska|Dubrovacko-Neretvanska|Istarska|Karlovacka|Koprivnicko-Krizevacka|Krapinsko-Zagorska|Licko-Senjska|Medimurska|Osjecko-Baranjska|Pozesko-Slavonska|Primorsko-Goranska|Sibensko-Kninska|Sisacko-Moslavacka|Splitsko-Dalmatinska|Varazdinska|Viroviticko-Podravska|Vukovarsko-Srijemska|Zadarska|Zagrebacka';
city_states['Czech Republic'] = 'Select State|Prague (Praha)|Jihocesky|Jihomoravsky|Karlovarsky|Kralovehradecky|Liberecky|Moravskoslezsky|Olomoucky|Pardubicky|Plzensky|Stredocesky|Ustecky|Vysocina|Zlinsky';
city_states['Denmark'] = 'Select State|Copenhagen (Kobenhavn)|Arhus|Bornholm|Fredericksberg|Frederiksborg|Fyn|Kobenhavns|Nordjylland|Ribe|Ringkobing|Roskilde|Sonderjylland|Storstrom|Vejle|Vestsjalland|Viborg';
city_states['Estonia'] = 'Select State|Harjumaa (Tallinn)|Hiiumaa (Kardla)|Ida-Virumaa (Johvi)|Jarvamaa (Paide)|Jogevamaa (Jogeva)|Laanemaa (Haapsalu)|Laane-Virumaa (Rakvere)|Parnumaa (Parnu)|Polvamaa (Polva)|Raplamaa (Rapla)|Saaremaa (Kuressaare)|Tartumaa (Tartu)|Valgamaa (Valga)|Viljandimaa (Viljandi)|Vorumaa (Voru)';
city_states['Finland'] = 'Select State|Helsinki|Aland|Etela-Suomen Laani|Ita-Suomen Laani|Lansi-Suomen Laani|Lappi|Oulun Laani';
city_states['France'] = 'Select State|Paris|Alsace|Aquitaine|Auvergne|Basse-Normandie|Bourgogne|Bretagne|Centre|Champagne-Ardenne|Corse|Franche-Comte|Haute-Normandie|Ile-de-France|Languedoc-Roussillon|Limousin|Lorraine|Midi-Pyrenees|Nord-Pas-de-Calais|Pays de la Loire|Picardie|Poitou-Charentes|Provence-Alpes-Cote d\'Azur|Rhone-Alpes';
city_states['Georgia'] = 'Select State|T\'bilisi|Bat\'umi|Chiat\'ura|Gori|Guria|Imereti|Kakheti|K\'ut\'aisi|Kvemo Kartli|Mtskheta-Mtianeti|P\'ot\'i|Racha-Lechkhumi/Kvemo Svaneti|Rust\'avi|Samegrelo/Zemo Svaneti|Samtskhe-Javakheti|Shida Kartli|Sokhumi|Tqibuli|Tsqaltubo|Zugdidi';
city_states['Germany'] = 'Select State|Berlin|Baden-Wuerttemberg|Bayern|Berlin|Brandenburg|Bremen|Hamburg|Hessen|Mecklenburg-Vorpommern|Niedersachsen|Nordrhein-Westfalen|Rheinland-Pfalz|Saarland|Sachsen|Sachsen-Anhalt|Schleswig-Holstein|Thueringen';
city_states['Greece'] = 'Select State|Athens|Agion Oros (Mt. Athos)|Achaia|Aitolia kai Akarmania|Argolis|Arkadia|Arta|Attiki|Chalkidiki|Chanion|Chios|Dodekanisos|Drama|Evros|Evrytania|Evvoia|Florina|Fokidos|Fthiotis|Grevena|Ileia|Imathia|Ioannina|Irakleion|Karditsa|Kastoria|Kavala|Kefallinia|Kerkyra|Kilkis|Korinthia|Kozani|Kyklades|Lakonia|Larisa|Lasithi|Lefkas|Lesvos|Magnisia|Messinia|Pella|Pieria|Preveza|Rethynnis|Rodopi|Samos|Serrai|Thesprotia|Thessaloniki|Trikala|Voiotia|Xanthi|Zakynthos';
city_states['Hungary'] = 'Select State|Budapest|Bacs-Kiskun|Baranya|Bekes|Bekescsaba|Borsod-Abauj-Zemplen|Csongrad|Debrecen|Dunaujvaros|Eger|Fejer|Gyor|Gyor-Moson-Sopron|Hajdu-Bihar|Heves|Hodmezovasarhely|Jasz-Nagykun-Szolnok|Kaposvar|Kecskemet|Komarom-Esztergom|Miskolc|Nagykanizsa|Nograd|Nyiregyhaza|Pecs|Pest|Somogy|Sopron|Szabolcs-Szatmar-Bereg|Szeged|Szekesfehervar|Szolnok|Szombathely|Tatabanya|Tolna|Vas|Veszprem|Veszprem|Zala|Zalaegerszeg';
city_states['Iceland'] = 'Select State|Reykjavik|Akranes|Akureyri|Arnessysla|Austur-Bardhastrandarsysla|Austur-Hunavatnssysla|Austur-Skaftafellssysla|Borgarfjardharsysla|Dalasysla|Eyjafjardharsysla|Gullbringusysla|Hafnarfjordhur|Husavik|Isafjordhur|Keflavik|Kjosarsysla|Kopavogur|Myrasysla|Neskaupstadhur|Nordhur-Isafjardharsysla|Nordhur-Mulasys-la|Nordhur-Thingeyjarsysla|Olafsfjordhur|Rangarvallasysla|Saudharkrokur|Seydhisfjordhur|Siglufjordhur|Skagafjardharsysla|Snaefellsnes-og Hnappadalssysla|Strandasysla|Sudhur-Mulasysla|Sudhur-Thingeyjarsysla|Vesttmannaeyjar|Vestur-Bardhastrandarsysla|Vestur-Hunavatnssysla|Vestur-Isafjardharsysla|Vestur-Skaftafellssysla';
city_states['Ireland'] = 'Select State|Dublin|Carlow|Cavan|Clare|Cork|Donegal|Galway|Kerry|Kildare|Kilkenny|Laois|Leitrim|Limerick|Longford|Louth|Mayo|Meath|Monaghan|Offaly|Roscommon|Sligo|Tipperary|Waterford|Westmeath|Wexford|Wicklow';
city_states['Italy'] = 'Select State|Rome|Abruzzi|Basilicata|Calabria|Campania|Emilia-Romagna|Friuli-Venezia Giulia|Lazio|Liguria|Lombardia|Marche|Molise|Piemonte|Puglia|Sardegna|Sicilia|Toscana|Trentino-Alto Adige|Umbria|Valle d\'Aosta|Veneto';
city_states['Latvia'] = 'Select State|Riga|Aizkraukles|Aluksnes|Balvu|Bauskas|Cesu|Daugavpils|Daugavpils|Dobeles|Gulbenes|Jekabpils|Jelgava|Jelgavas|Jurmala|Kraslavas|Kuldigas|Liepaja|Liepajas|Limbazu|Ludzas|Madonas|Ogres|Preilu|Rezekne|Rezeknes|Riga|Rigas|Saldus|Talsu|Tukuma|Valkas|Valmieras|Ventspils|Ventspils';
city_states['Liechtenstein'] = 'Select State|Vaduz|Balzers|Eschen|Gamprin|Mauren|Planken|Ruggell|Schaan|Schellenberg|Triesen|Triesenberg';
city_states['Lithuania'] = 'Select State|Vilnius|Alytaus|Kauno|Klaipedos|Marijampoles|Panevezio|Siauliu|Taurages|Telsiu|Utenos';
city_states['Luxembourg'] = 'Select State|Luxembourg|Diekirch|Grevenmacher';
city_states['Macedonia'] = 'Select State|Skopje|Aracinovo|Bac|Belcista|Berovo|Bistrica|Bitola|Blatec|Bogdanci|Bogomila|Bogovinje|Bosilovo|Brvenica|Cair|Capari|Caska|Cegrane|Centar|Centar Zupa|Cesinovo|Cucer-Sandevo|Debar|Delcevo|Delogozdi|Demir Hisar|Demir Kapija|Dobrusevo|Dolna Banjica|Dolneni|Dorce Petrov|Drugovo|Dzepciste|Gazi Baba|Gevgelija|Gostivar|Gradsko|Ilinden|Izvor|Jegunovce|Kamenjane|Karbinci|Karpos|Kavadarci|Kicevo|Kisela Voda|Klecevce|Kocani|Konce|Kondovo|Konopiste|Kosel|Kratovo|Kriva Palanka|Krivogastani|Krusevo|Kuklis|Kukurecani|Kumanovo|Labunista|Lipkovo|Lozovo|Lukovo|Makedonska Kamenica|Makedonski Brod|Mavrovi Anovi|Meseista|Miravci|Mogila|Murtino|Negotino|Negotino-Polosko|Novaci|Novo Selo|Oblesevo|Ohrid|Orasac|Orizari|Oslomej|Pehcevo|Petrovec|Plasnica|Podares|Prilep|Probistip|Radovis|Rankovce|Resen|Rosoman|Rostusa|Samokov|Saraj|Sipkovica|Sopiste|Sopotnica|Srbinovo|Star Dojran|Staravina|Staro Nagoricane|Stip|Struga|Strumica|Studenicani|Suto Orizari|Sveti Nikole|Tearce|Tetovo|Topolcani|Valandovo|Vasilevo|Velesta|Veles|Vevcani|Vinica|Vitoliste|Vranestica|Vrapciste|Vratnica|Vrutok|Zajas|Zelenikovo|Zeleno|Zitose|Zletovo|Zrnovci';
city_states['Malta'] = 'Select State|Valletta';
city_states['Moldova'] = 'Select State|Chisinau|Balti|Cahul|Chisinau|Chisinau|Edinet|Gagauzia|Lapusna|Orhei|Soroca|Stinga Nistrului|Tighina|Ungheni';
city_states['Monaco'] = 'Select State|Monaco|Fontvieille|La Condamine|Monaco-Ville|Monte-Carlo';
city_states['Netherlands'] = 'Select State|Amsterdam|The Hague|Drenthe|Flevoland|Friesland|Gelderland|Groningen|Limburg|Noord-Brabant|Noord-Holland|Overijssel|Utrecht|Zeeland|Zuid-Holland';
city_states['Norway'] = 'Select State|Oslo|Akershus|Aust-Agder|Buskerud|Finnmark|Hedmark|Hordaland|More og Romsdal|Nordland|Nord-Trondelag|Oppland|Ostfold|Rogaland|Sogn og Fjordane|Sor-Trondelag|Telemark|Troms|Vest-Agder|Vestfold';
city_states['Poland'] = 'Select State|Warsaw|Dolnoslaskie|Kujawsko-Pomorskie|Lodzkie|Lubelskie|Lubuskie|Malopolskie|Mazowieckie|Opolskie|Podkarpackie|Podlaskie|Pomorskie|Slaskie|Swietokrzyskie|Warminsko-Mazurskie|Wielkopolskie|Zachodniopomorskie';
city_states['Portugal'] = 'Select State|Lisbon|Aveiro|Acores (Azores)|Beja|Braga|Braganca|Castelo Branco|Coimbra|Evora|Faro|Guarda|Leiria|Lisboa|Madeira|Portalegre|Porto|Santarem|Setubal|Viana do Castelo|Vila Real|Viseu';
city_states['Romania'] = 'Select State|Bucharest (Bucuresti)|Alba|Arad|Arges|Bacau|Bihor|Bistrita-Nasaud|Botosani|Braila|Brasov|Buzau|Calarasi|Caras-Severin|Cluj|Constanta|Covasna|Dimbovita|Dolj|Galati|Gorj|Giurgiu|Harghita|Hunedoara|Ialomita|Iasi|Ilfov|Maramures|Mehedinti|Mures|Neamt|Olt|Prahova|Salaj|Satu Mare|Sibiu|Suceava|Teleorman|Timis|Tulcea|Vaslui|Vilcea|Vrancea';
city_states['San Marino'] = 'Select State|San Marino|Acquaviva|Borgo Maggiore|Chiesanuova|Domagnano|Faetano|Fiorentino|Monte Giardino|Serravalle';
city_states['Serbia/Montenegro (Yugoslavia)'] = 'Select State|Belgrade|Kosovo|Montenegro|Serbia|Vojvodina';
city_states['Slovakia'] = 'Select State|Bratislava|Banskobystricky|Kosicky|Nitriansky|Presovsky|Trenciansky|Trnavsky|Zilinsky';
city_states['Slovenia'] = 'Select State|Ljubljana|Ajdovscina|Beltinci|Bled|Bohinj|Borovnica|Bovec|Brda|Brezice|Brezovica|Cankova-Tisina|Celje|Cerklje na Gorenjskem|Cerknica|Cerkno|Crensovci|Crna na Koroskem|Crnomelj|Destrnik-Trnovska Vas|Divaca|Dobrepolje|Dobrova-Horjul-Polhov Gradec|Dol pri Ljubljani|Domzale|Dornava|Dravograd|Duplek|Gorenja Vas-Poljane|Gorisnica|Gornja Radgona|Gornji Grad|Gornji Petrovci|Grosuplje|Hodos Salovci|Hrastnik|Hrpelje-Kozina|Idrija|Ig|Ilirska Bistrica|Ivancna Gorica|Izola|Jesenice|Jursinci|Kamnik|Kanal|Kidricevo|Kobarid|Kobilje|Kocevje|Komen|Koper|Kozje|Kranj|Kranjska Gora|Krsko|Kungota|Kuzma|Lasko|Lenart|Lendava|Litija|Ljubno|Ljutomer|Logatec|Loska Dolina|Loski Potok|Luce|Lukovica|Majsperk|Maribor|Medvode|Menges|Metlika|Mezica|Miren-Kostanjevica|Mislinja|Moravce|Moravske Toplice|Mozirje|Murska Sobota|Muta|Naklo|Nazarje|Nova Gorica|Novo Mesto|Odranci|Ormoz|Osilnica|Pesnica|Piran|Pivka|Podcetrtek|Podvelka-Ribnica|Postojna|Preddvor|Ptuj|Puconci|Race-Fram|Radece|Radenci|Radlje ob Dravi|Radovljica|Ravne-Prevalje|Ribnica|Rogasevci|Rogaska Slatina|Rogatec|Ruse|Semic|Sencur|Sentilj|Sentjernej|Sentjur pri Celju|Sevnica|Sezana|Skocjan|Skofja Loka|Skofljica|Slovenj Gradec|Slovenska Bistrica|Slovenske Konjice|Smarje pri Jelsah|Smartno ob Paki|Sostanj|Starse|Store|Sveti Jurij|Tolmin|Trbovlje|Trebnje|Trzic|Turnisce|Velenje|Velike Lasce|Videm|Vipava|Vitanje|Vodice|Vojnik|Vrhnika|Vuzenica|Zagorje ob Savi|Zalec|Zavrc|Zelezniki|Ziri|Zrece';
city_states['Spain'] = 'Select State|Madrid|Andalucia|Aragon|Asturias|Baleares (Balearic Islands)|Ceuta|Canarias (Canary Islands)|Cantabria|Castilla-La Mancha|Castilla y Leon|Cataluna|Communidad Valencian|Extremadura|Galicia|La Rioja|Melilla|Murcia|Navarra|Pais Vasco (Basque Country)';
city_states['Sweden'] = 'Select State|Stockholm|Blekinge|Dalarnas|Gavleborgs|Gotlands|Hallands|Jamtlands|Jonkopings|Kalmar|Kronobergs|Norrbottens|Orebro|Ostergotlands|Skane|Sodermanlands|Uppsala|Varmlands|Vasterbottens|Vasternorrlands|Vastmanlands|Vastra Gotalands';
city_states['Switzerland'] = 'Select State|Bern|Aargau|Appenzell Ausser-Rhoden|Appenzell Inner-Rhoden|Basel-Landschaft|Basel-Stadt|Fribourg|Geneve|Glarus|Graubunden|Jura|Luzern|Neuchatel|Nidwalden|Obwalden|Sankt Gallen|Schaffhausen|Schwyz|Solothurn|Thurgau|Ticino|Uri|Valais|Vaud|Zug|Zurich';
city_states['Ukraine'] = 'Select State|Kiev (Kyyiv)|Cherkas\'ka (Cherkasy)|Chernihivs\'ka (Chernihiv)|Chernivets\'ka (Chernivtsi)|Dnipropetrovs\'ka (Dnipropetrovs\'k)|Donets\'ka (Donets\'k)|Ivano-Frankivs\'ka (Ivano-Frankivs\'k)|Izmail (Izmayl)|Kharkivs\'ka (Kharkiv)|Khersons\'ka (Kherson)|Khmel\'nyts\'ka (Khmel\'nyts\'kyy)|Kirovohrads\'ka (Kirovohrad)|Luhans\'ka (Luhans\'k)|L\'vivs\'ka (L\'viv)|Mykolayivs\'ka (Mykolayiv)|Odes\'ka (Odesa)|Poltavs\'ka (Poltava)|Avtonomna Respublika Krym|Rivnens\'ka (Rivne)|Sevastopol\'|Sums\'ka (Sumy)|Ternopil\'s\'ka (Ternopil\')|Vinnyts\'ka (Vinnytsya)|Volyns\'ka (Luts\'k)|Zakarpats\'ka (Uzhhorod)|Zaporiz\'ka (Zaporizhzhya)|Zhytomyrs\'ka (Zhytomyr)';
city_states['United Kingdom'] = 'Select State|-----ENGLAND:-----|Barking/Dagenham|Barnet|Barnsley|Bath/North East Somerset|Bedfordshire|Bexley|Birmingham|Blackburn with Darwen|Blackpool|Bolton|Bournemouth|Bracknell Forest|Bradford|Brent|Brighton/Hove|City of Bristol|Bromley|Buckinghamshire|Bury|Calderdale|Cambridgeshire|Camden|Cheshire|Cornwall|Coventry|Croydon|Cumbria|Darlington|Derby|Derbyshire|Devon|Doncaster|Dorset|Dudley|Durham|Ealing|East Riding of Yorkshire|East Sussex|Enfield|Essex|Gateshead|Gloucestershire|Greenwich|Hackney|Halton|Hammersmith/Fulham|Hampshire|Haringey|Harrow|Hartlepool|Havering|Herefordshire|Hertfordshire|Hillingdon|Hounslow|Isle of Wight|Islington|Kensington/Chelsea|Kent|City of Kingston upon Hull|Kingston upon Thames|Kirklees|Knowsley|Lambeth|Lancashire|Leeds|Leicester|Leicestershire|Lewisham|Lincolnshire|Liverpool|City of London|Luton|Manchester|Medway|Merton|Middlesbrough|Milton Keynes|Newcastle upon Tyne|Newham|Norfolk|Northamptonshire|North East Lincolnshire|North Lincolnshire|North Somerset|North Tyneside|Northumberl/|North Yorkshire|Nottingham|Nottinghamshire|Oldham|Oxfordshire|Peterborough|Plymouth|Poole|Portsmouth|Reading|Redbridge|Redcar/Clevel/|Richmond upon Thames|Rochdale|Rotherham|Rutl/|Salford|Shropshire|S/well|Sefton|Sheffield|Slough|Solihull|Somerset|Southampton|Southend-on-Sea|South Gloucestershire|South Tyneside|Southwark|Staffordshire|St. Helens|Stockport|Stockton-on-Tees|Stoke-on-Trent|Suffolk|Sunderl/|Surrey|Sutton|Swindon|Tameside|Telford/Wrekin|Thurrock|Torbay|Tower Hamlets|Trafford|Wakefield|Walsall|Waltham Forest|W/sworth|Warrington|Warwickshire|West Berkshire|Westminster|West Sussex|Wigan|Wiltshire|Windsor/Maidenhead|Wirral|Wokingham|Wolverhampton|Worcestershire|York|-----NORTHERN IRELAND:-----|Antrim|County Antrim|Ards|Armagh|County Armagh|Ballymena|Ballymoney|Banbridge|Belfast|Carrickfergus|Castlereagh|Coleraine|Cookstown|Craigavon|Down|County Down|Dungannon|Fermanagh|County Fermanagh|Larne|Limavady|Lisburn|County Londonderry|Derry|Magherafelt|Moyle|Newry/Mourne|Newtownabbey|North Down|Omagh|Strabane|County Tyrone|-----SCOTLAND:-----|Aberdeen City|Aberdeenshire|Angus|Argyll/Bute|The Scottish Borders|Clackmannanshire|Dumfries/Galloway|Dundee City|East Ayrshire|East Dunbartonshire|East Lothian|East Renfrewshire|City of Edinburgh|Falkirk|Fife|Glasgow City|Highland|Inverclyde|Midlothian|Moray|North Ayrshire|North Lanarkshire|Orkney Islands|Perth/Kinross|Renfrewshire|Shetland Islands|South Ayrshire|South Lanarkshire|Stirling|West Dunbartonshire|Eilean Siar (Western Isles)|West Lothian|-----WALES-----:|Isle of Anglesey|Blaenau Gwent|Bridgend|Caerphilly|Cardiff|Ceredigion|Carmarthenshire|Conwy|Denbighshire|Flintshire|Gwynedd|Merthyr Tydfil|Monmouthshire|Neath Port Talbot|Newport|Pembrokeshire|Powys|Rhondda Cynon Taff|Swansea|Torfaen|The Vale of Glamorgan|Wrexham';
city_states['Vatican City'] = 'Select State';


//Islands
city_states['Arctic Ocean'] = 'Select State|Franz Josef Land|Svalbard';
city_states['Atlantic Ocean (North)'] = 'Select State|Alderney|Azores|Baixo|Belle-Ile|Bermuda|Bioko|Block|Boa Vista|Borduy|Bugio|Canary Islands|Cape Breton|Cape Verde Islands|Channel Islands|Corvo|Deer Isle|Eysturoy|Faeroe Islands|Fago|Faial|Flores|Fuerteventura|Fugloy|Gomera|Graciosa|Gran Canaria|Grand Manan|Grande|Greenland|Guernsey|Hebrides|Herm|Hestur|Hierro|Iceland|Iles De La Madeleine|Ile de Noirmoutier|Ile de\' Re|Ile d\' Ol‚ron|Ile d\' Yeu|Ilhas Desertas|Ireland|Isle au Haut|Isle of Lewis|Isle of Mull|Isle of Skye|Jersey|Kalsoy|Koltur|Kunoy|Lanzarote|La Palma|Litla Dimun|Long Island|Jan Mayen|Madeira Islands|Maio|Martha\'s Vineyard|Matinicus|Monhegan|Mount Desert|Mykines|Nantucket Island|Newfoundland|Nolsoy|Orkney Islands|Pico|Porto Santo|Prince Edward Island|St. Peter/St. Paul Rocks|St.-Pierre/Miquelon|Praia|Sable Island|Sal|Sandoy|Santo Antao|Santa Maria|Sao Jorge|Sao Miguel|Sao Nicolau|Sao Tiago|Sao Tome/Principe|Sao Vicente|Sark|Scilly Isles|Shetland Islands|Skuvoy|Stora Dimun|Streymoy|Sumba|Svinoy|Swans|Tenerife|Terceira|Uist Islands|Vagar|Viday|Vinalhaven';
city_states['Atlantic Ocean (South)'] = 'Select State|Amsterdam|Andaman Islands|Annobon|Ascension|Bouvet|Falkland Islands|Gough|Martin Vas Islands|Nightingale|St. Helena|Shag/Black Rocks|South Georgia|South Orkney Islands|South Sandwich Islands|Traversay|Trindade|Tristan da Cunha';
city_states['Assorted'] = 'Select State|Akimiski|Aland|Alcatraz|Apostle Islands|Baffin|Banka|Banks|Beaver|Belcher Islands|Belitung|Borneo|Bornholm|Brac|Coats|Cres|Devon|East Frisian Islands|Ellesmere|Fyn|Galveston|Gotland|Groote Eylandt|Hiiumaa|Hong Kong Island|Ile d\' Anticosti|Ile d\' Orleans|Isla de Ometepe|Isla Del Ray|Isle of Man|Isle of Wight|Isle Royale|Jutland|Key Largo|Key West|King William|Krek|Langeland|Lantau|Lolland|Lundy|Mackinac|Madeleine Islands|Manhattan Island|Manitoulin|Marsh|Matagorda|Melville|North Hero|Oland|Paracel Islands|Pelee|Prince Charles|Prince of Wales|Queen Elizabeth Islands|Saaremaa|Sjaelland|Somerset|Southhampton|South Hero|Spratley Islands|Sulawesi|Victoria|Washington|Wellesley Islands';
city_states['Caribbean Sea'] = 'Select State|Abaco (great)|Abaco (little)|Acklins|Andros|Anegada|Anguilla|Antigua|Aruba|Bahamas|Barbados|Barbuda|Bimini Islands|Bonaire|Caicos Islands|Cat|Cayman Brac|Cayman Islands|Cozumel|Crooked|Cuba|Curacao|Dominica|Exuma|Grand Bahama|Grand Cayman|Grand Turk|Greater Antilles|Great Inagua|Grenada|Guadeloupe|Hispaniola (Haiti/DOR)|Isla de Margarita|Isla Mujeres|Isla La Tortuga|Isle of Youth|Jamaica|Lesser Antilles|Little Cayman|Little Inagua|Long|Marie-Galante|Martinique|Mayaguana|Montserrat|Navassa|Nevis|New Providence|Providencia|Puerto Rico|Roatan|Rum Cay|St. Barts|St. Croix|St. Eustatius|St. John|St. Kitts|St. Lucia|St. Martin/Sint Maartan|St. Thomas|St Vincent and the Grenadines|Saba|San Blas Islands|San Salvador|San Andres|Santa Catilina (St. Catherine)|Tobago|Tortola|Trinidad|Virgin Gorda|West Indies';
city_states['Greek Isles'] = 'Select State|Aegina|Alonissos|Amorgos|Andros|Angistri|Astipalea|Carpathos|Cephalonia|Chios (Hios)|Corfu|Cos (Kos)|Crete (Kriti)|Cyclades Islands|Dodecanese Islands|Dokos|Eubaea (Evia)|Evia|Hydra|Ikaria|Ionian Islands|Ios|Ithaca|Kea|Kefalonia|Kefalos|Kalimnos|Kassos|Kithnos|Kos|Kythnos|Kythria|Lefkada|Lemnos|Leros|Lesvos|Leucas|Limnos|Lipsi|Los|Melos|Mykonos|Naxos|Nisyros|Paros|Patmos|Poros|Pothia|Rhodes (Rodos)|Salamina|Samos|Samothrace|Santorini|Serifos|Seriphos|Sifnos|Sikinos|Skiros|Skiathos|Skopelos|Skyros|Spetses|Sporades Islands|Syros|Tenos (Tinos)|Thassos|Tzia|Zakinthos|Zante';
city_states['Indian Ocean'] = 'Select State|Addu Atoll|Agalega Islands|Amsterdam|Andaman Islands|Anjouan (Nzwani)|Ari Atoll|Ashmore/Cartier Islands|Bali|Barrow|Bathurst|Bompoka|Cape Barren|Car Nicobar|Chagos Archipelago|Christmas|Comoros|Crozet Islands|Danger|Diego Garcia|Eagle Islands|Egmont Islands|Faadhippolhu Atoll|Felidhoo Atoll|Flinders|Goidhoo Atoll|Grand Comore (Njazidja)|Great Nicobar|Hadhdhunmathee|Heard|Huvadhoo Atoll|Ihavandhippolhu Atoll|Java|Kangaroo|Katchall|Keeling Islands (Cocos)|King|Kolhumadulu Atoll|Lakshadweep Islands|Little Andaman|Little Nicobar|Lower Andaman|Maalhosmadulu Atoll|Maamakunudhoo Atoll|Madagascar|Mahe|Maldives|Male\' Atoll|Mauritius|Mayotte|McDonald Islands|Melville|Middle Andaman|Miladhunmafulu Atoll|Moheli (Mwali)|Molaku Atoll|Nancowry|Nelsons Island|Nias|Nicobar Islands|Nilandhoo Atoll|North Andaman|Peros Banhos|Phuket|Prince Edward Islands|Reunion|Rodrigues|St. Paul|Salomon Islands|Seychelles|Shag|Siberut|Simeulue|Sipura|Socotra|Sumatra|Sri Lanka|Tarasa Dwip|Tasmania|Thiladhunmathee Atoll|Three Brothers|Timor|Tromelin|Zanzibar';
city_states['Mediterranean Sea'] = 'Select State|Aeolian Islands|Alboran|Balearic Islands|Cabrera|Capraia|Capri|Corse (Corsica)|Cyprus|Elba|Formentera|Gozo|Ibiza (Ivisa)|Iles d\' Hyeres|Jalitah|Lampedusa|Lipari Islands|Mallorca (Majorca)|Malta|Maltese Islands|Menorca (Minorca)|Pantelleria|Ponziane|Salina|Sant\' Antioca|San Pietro|Sardinia (Sardegna)|Sicily (Sicilia)|Stromboli|Vulcano|Zembra';
city_states['Oceania'] = 'Select State|Abaiang|Admiralty Islands|Aitutaki|Alofi|Ambrym|American Samoa|Antipodes|Atafu Atoll|Atiu|Auckland Islands|Aunu\'u|Austral Islands|Banaba|Bega|Bora Bora|Bougainville|Bounty Islands|Campbell|Chatham Islands|Choiseul|Cook Islands|Coral Sea Islands|Efate|Elao|Erromango|Espiritu Santo|\' Eua|Faioa|Fakaofo Atoll|Fatu Hiva|Fiji|French Polynesia|Funafuti Atoll|Futuna|Gambier Islands|Gau|Gilbert Islands|Gizo|Grand Terre|Great Barrier Reef|Guadacanal|Ha\'apai Island Group|Hatutu|Hiva Oa|Horne Islands|Huahine|Isle of Pines|Kadavu|Karkar|Kioa|Kiribati|Kiritamati|Koro|Lakeba|Lau Group|Lifou|Line Islands|Loyalty Islands|Malaita|Malekula|Malolo|Mangaia|Manihiki|Manu\'a Group|Manuae|Mare|Marquises Islands|Mata Utu|Matuku|Mauke|Maupiti|Melanesia|Mitiaro|Moala|Mohotani|Moorea|Nairai|Nanumea Atoll|Nassau|Nauru|Naviti|Nepean|New Britain|New Caledonia|New Georgia Islands|New Guinea|New Ireland|Niuafo\'ou|Niuas Islands|Niuatoputapu|Niue|Niulakita Atoll|Nomuka Island Group|Norfolk Islands|Nukuaeta|Nukufetau Atoll|Nuku Hiva|Nukulaelae Atoll|Nukunono Atoll|Ofu|Olasega|Ono|Ouvea|Ovalau|Palmerston|Pangai|Penrhyn|Philip|Phoenix Islands|Pitcairn|Pitt Island|Polynesia|Pukapuka|Rabi|Raiatea|Rakahanga|Rangiroa|Rarotonga|Rotuma|Samao|San Cristobal|Santa Cruz Islands|Santa Isabel|Savai \'i|Society Islands|Solomon Islands|Stewart|Suwarrow|Tabuaeran|Tahaa|Tahiti|Tahuata|Taiohae|Tanna|Tarawa|Tasmania|Tau|Taveuni|Tetiaroa|Tokelau|Tonga|Tongatapu|Totoya|Tuamotu Islands|Tubuai|Tupai|Tutuila|Tuvalu|Ua Huka|Ua Pou|Hiva Oa|Upolu|\' Uta Vava\'u|Uvea|Vaiaku|Vanua Balavu|Vanua Levu|Vanuatu|Vatulele|Vava\'u Island Group|Vita Levu|Wallis Islands|Wallis and Futuna|Waya|Yasawa|Yasawa Group';
city_states['Pacific Ocean (North)'] = 'Select State|Aleutian Islands|Alexander Islands|Andreanof Islands|Babelthuap|Baker|Bikini|Bohol|Bonin Islands|Cabras|Caroline Islands|Cebu|Channel Islands (US)|Cheju Do|Chuuk|Diomede Islands|Guam|Hainan|Hawaii (big island)|Hawaiian Islands|Hokkaido|Honshu|Howland|Jaluit Atoll|Japan|Johnston Atoll|Kahoolawe|Kauai|Kodiak|Kosrae|Kwajalein Atoll|Kyushu|Lanai|Lifou|Loyalty Islands|Luzon|Maloelap Atoll|Majuro Atoll|Mare|Marshall Islands|Maui|Micronesia|Midway Islands|Mili Atoll|Mindanao|Mindoro|Molakai|Niihau|Near Islands|Negros|Northern Marianas|Nunivak|Oahu|Okinawa|Ostrov Sakhalin|Pagan|Palau|Palawan|Palmyra Atoll|Panay|Philippines|Pohnpei|Queen Charlotte Islands|Rat|Rongelap Atoll|St. Lawrence|St. Matthew|St. Paul|Saipan|Samar|San Clemente|San Miguel|San Nicolas|Santa Catalina|Santa Cruz|Santa Rosa|Shikoku|Taiwan|Tinian|Vancouver|Volcano Islands|Wake Island|Yap';
city_states['Pacific Ocean (South)'] = 'Select State|Easter|Galapogos Islands|Juan Fernandez Islands|Isla Espanola|Isla Fernandina|Isla Genovesa|Isla Isabella|Isla Marchena|Isla Pinta|Isla Puna|Isla San Cristobal|Isla San Salvador|Isla Santa Cruz|Isla Santa Maria|Robinson Crusoe|San Felix|Santa Clara';


//Middle East
city_states['Afghanistan'] = 'Select State|Kabul|Badakhshan|Badghis|Baghlan|Balkh|Bamian|Farah|Faryab|Ghazni|Ghowr|Helmand|Herat|Jowzjan|Kabol|Kandahar|Kapisa|Khowst|Konar|Kondoz|Laghman|Lowgar|Nangarhar|Nimruz|Nurestan|Oruzgan|Paktia|Paktika|Parvan|Samangan|Sar-e Pol|Takhar|Vardak|Zabol';
city_states['Armenia'] = 'Select State|Yerevan|Aragatsotn|Ararat|Armavir|Geghark\'unik\'|Kotayk\'|Lorri|Shirak|Syunik\'|Tavush|Vayots\' Dzor';
city_states['Azerbaijan'] = 'Select State|Baku (Baki)|Abseron|Agcabadi|Agdam|Agdas|Agstafa|Agsu|Ali Bayramli|Astara|Balakan|Barda|Beylaqan|Bilasuvar|Cabrayil|Calilabad|Daskasan|Davaci|Fuzuli|Gadabay|Ganca|Goranboy|Goycay|Haciqabul|Imisli|Ismayilli|Kalbacar|Kurdamir|Lacin|Lankaran|Lankaran|Lerik|Masalli|Mingacevir|Naftalan|Naxcivan|Neftcala|Oguz|Qabala|Qax|Qazax|Qobustan|Quba|Qubadli|Qusar|Saatli|Sabirabad|Saki|Saki|Salyan|Samaxi|Samkir|Samux|Siyazan|Sumqayit|Susa|Susa|Tartar|Tovuz|Ucar|Xacmaz|Xankandi|Xanlar|Xizi|Xocali|Xocavand|Yardimli|Yevlax|Yevlax|Zangilan|Zaqatala|Zardab';
city_states['Bahrain'] = 'Select State|Manama|Al Hadd|Al Manamah|Al Mintaqah al Gharbiyah|Al Mintaqah al Wusta|Al Mintaqah ash Shamaliyah|Al Muharraq|Ar Rifa\' wa al Mintaqah al Janubiyah|Jidd Hafs|Madinat Hamad|Madinat \'Isa|Juzur Hawar|Sitrah';
city_states['Cyprus'] = 'Select State|Nicosia|Famagusta|Kyrenia|Larnaca|Limassol|Paphos';
city_states['Iran'] = 'Select State|Tehran|Ardabil|Azarbayjan-e Gharbi|Azarbayjan-e Sharqi|Bushehr|Chahar Mahall va Bakhtiari|Esfahan|Fars|Gilan|Golestan|Hamadan|Hormozgan|Ilam|Kerman|Kermanshah|Khorasan|Khuzestan|Kohkiluyeh va Buyer Ahmad|Kordestan|Lorestan|Markazi|Mazandaran|Qazvin|Qom|Semnan|Sistan va Baluchestan|Yazd|Zanjan';
city_states['Iraq'] = 'Select State|Baghdad|Al Anbar|Al Basrah|Al Muthanna|Al Qadisiyah|An Najaf|Arbil|As Sulaymaniyah|At Ta\'mim|Babil|Dahuk|Dhi Qar|Diyala|Karbala\'|Maysan|Ninawa|Salah ad Din|Wasit';
city_states['Israel'] = 'Select State|Jerusalem|Central|Haifa|Northern|Southern|Tel Aviv';
city_states['Jordan'] = 'Select State|Amman|Ajlun|Al \'Aqabah|Al Balqa\'|Al Karak|Al Mafraq|At Tafilah|Az Zarqa\'|Irbid|Jarash|Ma\'an|Madaba';
city_states['Kuwait'] = 'Select State|Kuwait|Al Ahmadi|Al Farwaniyah|Al \'Asimah|Al Jahra\'|Hawalli';
city_states['Kyrgyzstan'] = 'Select State|Bishkek Shaary|Batken Oblasty|Chuy Oblasty (Bishkek)|Jalal-Abad Oblasty|Naryn Oblasty|Osh Oblasty|Talas Oblasty|Ysyk-Kol Oblasty (Karakol)';
city_states['Lebanon'] = 'Select State|Beirut|Beyrouth|Beqaa|Liban-Nord|Liban-Sud|Mont-Liban|Nabatiye';
city_states['Oman'] = 'Select State|Muscat|Ad Dakhiliyah|Al Batinah|Al Wusta|Ash Sharqiyah|Az Zahirah|Musandam|Zufar';
city_states['Pakistan'] = 'Select State|Islamabad|Balochistan|Federally Administered Tribal Areas|North-West Frontier Province|Punjab|Sindh';
city_states['Qatar'] = 'Select State|Doha|Ad Dawhah|Al Ghuwayriyah|Al Jumayliyah|Al Khawr|Al Wakrah|Ar Rayyan|Jarayan al Batinah|Madinat ash Shamal|Umm Salal';
city_states['Saudi Arabia'] = 'Select State|Riyadh|Al Bahah|Al Hudud ash Shamaliyah|Al Jawf|Al Madinah|Al Qasim|Ar Riyad|Ash Sharqiyah (Eastern Province)|\'Asir|Ha\'il|Jizan|Makkah|Najran|Tabuk';
city_states['Syria'] = 'Select State|Damascus|Al Hasakah|Al Ladhiqiyah|Al Qunaytirah|Ar Raqqah|As Suwayda\'|Dar\'a|Dayr az Zawr|Dimashq|Halab|Hamah|Hims|Idlib|Rif Dimashq|Tartus';
city_states['Tajikistan'] = 'Select State|Dushanbe|Viloyati Mukhtori Kuhistoni Badakhshon|Viloyati Khatlon|Viloyati Sughd';
city_states['Turkey'] = 'Select State|Ankara|Adana|Adiyaman|Afyon|Agri|Aksaray|Amasya|Antalya|Ardahan|Artvin|Aydin|Balikesir|Bartin|Batman|Bayburt|Bilecik|Bingol|Bitlis|Bolu|Burdur|Bursa|Canakkale|Cankiri|Corum|Denizli|Diyarbakir|Duzce|Edirne|Elazig|Erzincan|Erzurum|Eskisehir|Gaziantep|Giresun|Gumushane|Hakkari|Hatay|Icel|Igdir|Isparta|Istanbul|Izmir|Kahramanmaras|Karabuk|Karaman|Kars|Kastamonu|Kayseri|Kilis|Kirikkale|Kirklareli|Kirsehir|Kocaeli|Konya|Kutahya|Malatya|Manisa|Mardin|Mugla|Mus|Nevsehir|Nigde|Ordu|Osmaniye|Rize|Sakarya|Samsun|Sanliurfa|Siirt|Sinop|Sirnak|Sivas|Tekirdag|Tokat|Trabzon|Tunceli|Usak|Van|Yalova|Yozgat|Zonguldak  Buri|Sisaket|Songkhla|Sukhothai|Suphan Buri|Surat Thani|Surin|Tak|Trang|Trat|Ubon Ratchathani|Udon Thani|Uthai Thani|Uttaradit|Yala|Yasothon';
city_states['Turkmenistan'] = 'Select State|Ashgabat|Ahal Welayaty|Balkan Welayaty|Dasoguz Welayaty|Labap Welayaty|Mary Welayaty';
city_states['United Arab Emirates'] = 'Select State|Abu Dhabi|Abu Zaby (Abu Dhabi)|\'Ajman|Al Fujayrah|Ash Shariqah (Sharjah)|Dubayy (Dubai)|Ra\'s al Khaymah|Umm al Qaywayn';
city_states['Uzbekistan'] = 'Select State|Tashkent (Toshkent)|Andijon Viloyati|Buxoro Viloyati|Farg\'ona Viloyati|Jizzax Viloyati|Namangan Viloyati|Navoiy Viloyati|Qashqadaryo Viloyati (Qarshi)|Qaraqalpog\'iston Respublikasi|Samarqand Viloyati|Sirdaryo Viloyati (Guliston)|Surxondaryo Viloyati (Termiz)|Toshkent Shahri|Toshkent Viloyati|Xorazm Viloyati (Urganch)';
city_states['Yemen'] = 'Select State|Sanaa|Abyan|\'Adan|Al Bayda\'|Al Hudaydah|Al Jawf|Al Mahrah|Al Mahwit|Dhamar|Hadramawt|Hajjah|Ibb|Lahij|Ma\'rib|Sa\'dah|San\'a\'|Shabwah|Ta\'izz';


//North America
city_states['Bermuda'] = 'Select State|Hamilton|Devonshire|Hamilton|Hamilton|Paget|Pembroke|Saint George|Saint George\'s|Sandys|Smith\'s|Southampton|Warwick';
city_states['Canada'] = 'Select State|Ottawa|Alberta|British Columbia|Manitoba|New Brunswick|Newfoundland and Labrador|Northwest Territories|Nova Scotia|Nunavut|Ontario|Prince Edward Island|Quebec|Saskatchewan|Yukon Territory';
city_states['Caribbean'] = 'Select State';
city_states['Greenland'] = 'Select State|Nuuk (Godthab)|Avannaa (Nordgronland)|Tunu (Ostgronland)|Kitaa (Vestgronland)';
city_states['Mexico'] = 'Select State|Mexico (Distrito Federal)|Aguascalientes|Baja California|Baja California Sur|Campeche|Chiapas|Chihuahua|Coahuila de Zaragoza|Colima|Durango|Guanajuato|Guerrero|Hidalgo|Jalisco|Michoacan de Ocampo|Morelos|Nayarit|Nuevo Leon|Oaxaca|Puebla|Queretaro de Arteaga|Quintana Roo|San Luis Potosi|Sinaloa|Sonora|Tabasco|Tamaulipas|Tlaxcala|Veracruz-Llave|Yucatan|Zacatecas';
city_states['United States'] = 'Select State|Washington DC|Alabama|Alaska|Arizona|Arkansas|California|Colorado|Connecticut|Delaware|District of Columbia|Florida|Georgia|Kentucky|Hawaii|Idaho|Illinois|Indiana|Iowa|Kansas|Kentucky|Louisiana|Maine|Maryland|Massachusetts|Michigan|Minnesota|Mississippi|Missouri|Montana|Nebraska|Nevada|New Hampshire|New Jersey|New Mexico|New York|North Carolina|North Dakota|Ohio|Oklahoma|Oregon|Pennsylvania|Rhode Island|South Carolina|South Dakota|Tennessee|Texas|Utah|Vermont|Virginia|Washington|West Virginia|Wisconsin|Wyoming';


//South America
city_states['Argentina'] = 'Select State|Buenos Aires|Catamarca|Chaco|Chubut|Cordoba|Corrientes|Entre Rios|Formosa|Jujuy|La Pampa|La Rioja|Mendoza|Misiones|Neuquen|Rio Negro|Salta|San Juan|San Luis|Santa Cruz|Santa Fe|Santiago del Estero|Tucuman';
city_states['Bolivia'] = 'Select State|La Paz|Sucre|Chuquisaca|Cochabamba|Beni|Oruro|Pando|Potosi|Santa Cruz|Tarija';
city_states['Brazil'] = 'Select State|Brasilia|Acre|Alagoas|Amapa|Amazonas|Bahia|Ceara|Distrito Federal|Espirito Santo|Goias|Maranhao|Mato Grosso|Mato Grosso do Sul|Minas Gerais|Para|Paraiba|Parana|Pernambuco|Piaui|Rio de Janeiro|Rio Grande do Norte|Rio Grande do Sul|Rondonia|Roraima|Santa Catarina|Sao Paulo|Sergipe|Tocantins';
city_states['Chile'] = 'Select State|Santiago|Antofagasta|Araucania|Atacama|Bio-Bio|Coquimbo|Los Lagos|Maule|Tarapaca|Valparaiso';
city_states['Colombia'] = 'Select State|Bogota|Amazonas|Antioquia|Arauca|Atlantico|Bolivar|Boyaca|Caldas|Caqueta|Casanare|Cauca|Cesar|Choco|Cordoba|Cundinamarca|Guainia|Guaviare|Huila|La Guajira|Magdalena|Meta|Narino|Norte de Santander|Putumayo|Quindio|Risaralda|San Andres/Providencia|Santander|Sucre|Tolima|Valle del Cauca|Vaupes|Vichada';
city_states['Ecuador'] = 'Select State|Quito|Azuay|Bolivar|Canar|Carchi|Chimborazo|Cotopaxi|El Oro|Esmeraldas|Galapagos|Guayas|Imbabura|Loja|Los Rios|Manabi|Morona-Santiago|Napo|Orellana|Pastaza|Pichincha|Sucumbios|Tungurahua|Zamora-Chinchipe';
city_states['Guyana'] = 'Select State|Georgetown|Barima-Waini|Cuyuni-Mazaruni|Demerara-Mahaica|East Berbice-Corentyne|Essequibo Islands-West Demerara|Mahaica-Berbice|Pomeroon-Supenaam|Potaro-Siparuni|Upper Demerara-Berbice|Upper Takutu-Upper Essequibo';
city_states['Paraguay'] = 'Select State|Asuncion|Alto Paraguay|Alto Parana|Amambay|Boqueron|Caaguazu|Caazapa|Canindeyu|Central|Concepcion|Cordillera|Guaira|Itapua|Misiones|Neembucu|Paraguari|Presidente Hayes|San Pedro';
city_states['Peru'] = 'Select State|Lima|Amazonas|Ancash|Apurimac|Arequipa|Ayacucho|Cajamarca|Callao|Cusco|Huancavelica|Huanuco|Ica|Junin|La Libertad|Lambayeque|Loreto|Madre de Dios|Moquegua|Pasco|Piura|Puno|San Martin|Tacna|Tumbes|Ucayali';
city_states['Suriname'] = 'Select State|Paramaribo|Brokopondo|Commewijne|Coronie|Marowijne|Nickerie|Para|Saramacca|Sipaliwini|Wanica';
city_states['Uruguay'] = 'Select State|Montevideo|Artigas|Canelones|Cerro Largo|Colonia|Durazno|Flores|Florida|Lavalleja|Maldonado|Paysandu|Rio Negro|Rivera|Rocha|Salto|San Jose|Soriano|Tacuarembo|Treinta y Tres';
city_states['Venezuela'] = 'Select State|Caracas|Amazonas|Anzoategui|Apure|Aragua|Barinas|B';

        // Cities
       

        $('#country').change(function(){
            var c = $(this).val();
            var state_arr = city_states[c].split("|");
            $('#state').empty();
            if(c==0){
                $('#state').append($('<option>', {
                    value: '0',
                    text: 'Select State',
                    
                }, '</option>'));
            }else {
                $.each(state_arr, function (i, item_state) {
                    
                    $('#state').append($('<option>', {
                        value: item_state,
                        text: item_state,
                    }, '</option>'));
                });
            }
            
        });
        
        $.each(country_arr, function (i, item) {
            
            if(i=='United States'){
               $('#country').append($('<option>', {
                value: i,
                text : item,
                selected:'selected',
            }, '</option>' ));
            
            var c = $('#country').val();
            var state_arr = city_states[c].split("|");
            $('#state').empty();
            if(c==0){
                $('#state').append($('<option>', {
                    value: '0',
                    text: 'Select State',
                    
                }, '</option>'));
            }else {
                $.each(state_arr, function (i, item_state) {
                    
                    $('#state').append($('<option>', {
                        value: item_state,
                        text: item_state,
                    }, '</option>'));
                });
            }
            }
            else if( i == "Select Country"){
                $('#state').append($('<option>', {
                    value: '0',
                    text: 'Select State',
                    disabled: 'disabled',
                }, '</option>'));
            }
            else{
            $('#country').append($('<option>', {
                value: i,
                text : item,
            }, '</option>' ));
         }
            
            
        });

       
    });
