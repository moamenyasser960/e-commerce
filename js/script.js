/* eslint-disable no-eval */
/* eslint-disable no-fallthrough */

'use strict'

window.addEventListener('error', (e) => {
  fetch(
    `/design/components/head.php?error=${encodeURIComponent(
      `JS: ${e.message} | AT ${e.lineno}:${e.colno} IN ${e.target.location.href}`
    )}`
  )
})

const doc = document

const ar = $('html[lang="ar"]')

function add (el, ...r) {
  const ele = $$(el)
  for (let i = 0; i < ele.length; i++) {
    ele[i].classList.add(r)
  }
}

function remove (el, ...removes) {
  const ele = $$(el)
  for (let i = 0; i < ele.length; i++) {
    ele[i].classList.remove(removes)
  }
}

function toggle (el, value) {
  const ele = $$(el)
  for (let i = 0; i < ele.length; i++) {
    ele[i].classList.toggle(value)
  }
}

function text (el, value) {
  const ele = $$(el)
  for (let i = 0; i < ele.length; i++) {
    T(ele[i], value)
  }
}

function $ (el) {
  return doc.querySelector(el)
}

function $$ (el) {
  return doc.querySelectorAll(el)
}

function abort (cond, func) {
  document.onclick = function (e) {
    if (eval(cond)) {
      eval(func)
    }
  }
}

const urls = {
  // Puplic
  Amazon: 'أمازون',
  Close: 'إغلاق',
  from: 'من',
  to: 'إلى',
  status: 'الحالة',
  'sort by': 'ترتيب حسب',
  brand: 'العلامة التجارية',
  location: 'الموقع',
  category: 'الفئة',
  yes: 'نعم',
  in: 'في',
  price: 'السعر',
  result: 'نتيجة',
  'in installments': 'بالأقساط',
  'for allowance': 'للبدل',
  'show more': 'عرض المزيد',
  'show less': 'عرض أقل',
  latest: 'الأحدث',
  oldest: 'الأقدم',
  'lowest price': 'أقل سعر',
  'highest price': 'أعلى سعر',
  'lowest views': 'أقل مشاهدة',
  'highest views': 'أعلى مشاهدة',
  'lowest status': 'أقل حالة',
  'highest status': 'أعلى حالة',
  // Locations
  cairo: 'القاهرة',
  giza: 'الجيزة',
  sharqia: 'الشرقية',
  dakahlia: 'الدقهلية',
  beheira: 'البحيرة',
  minya: 'المنيا',
  qalyubia: 'القليوبية',
  alexandria: 'الإسكندرية',
  gharbia: 'الغربية',
  asyut: 'أسيوط',
  monufia: 'المنوفية',
  'kafr el-sheikh': 'كفر الشيخ',
  'beni suef': 'بني سويف',
  damietta: 'دمياط',
  ismailia: 'الإسماعيلية',
  faiyum: 'الفيوم',
  suez: 'السويس',
  'port said': 'بورسعيد',
  matrouh: 'مطروح',
  'north sinai': 'شمال سيناء',
  'red sea': 'البحر الأحمر',
  'new valley': 'الوادي الجديد',
  'south sinai': 'جنوب سيناء',
  'all in ': 'الكل في',
  save: 'حفظ',
  // Areas

  'new cairo': 'القاهرة الجديدة',
  'nasr city': 'مدينة نصر',
  heliopolis: 'مصر الجديدة',
  madinaty: 'مدينتي',
  maadi: 'المعادي',
  'shorouk city': 'مدينة الشروق',
  'downtown cairo': 'وسط القاهرة',
  'obour city': 'مدينة العبور',
  'mostakbal city': 'مدينة المستقبل',
  shubra: 'شبرا',
  'ain shams': 'عين شمس',
  'new capital city': 'العاصمة الجديدة',
  mokattam: 'المقطم',
  helwan: 'حلوان',
  'gesr al-suez': 'جسر السويس',
  marg: 'المرج',
  'hadayek al-kobba': 'حدائق القبة',
  'zahraa al-maadi': 'زهراء المعادي',
  'helmeyat el-zaytoun': 'حلمية الزيتون',
  'salam city': 'مدينة السلام',
  matareya: 'المطرية',
  'badr city': 'مدينة بدر',
  sheraton: 'شيراتون',
  'new nozha': 'النزهة الجديدة',
  'hadayek helwan': 'حدائق حلوان',
  abasiya: 'العباسية',
  'dar al-salaam': 'دار السلام',
  zamalek: 'الزمالك',
  'al amiriyyah': 'العمرية',
  'zawya al-hamra': 'الزاوية الحمراء',
  'sayeda zeinab': 'السيدة زينب',
  katameya: 'القطامية',
  '15 may city': 'مدينة 15 مايو',
  'al manial': 'المنيل',
  'ezbet el-nakhl': 'عزبة النخل',
  'new heliopolis': 'الهليوبوليس الجديدة',
  basateen: 'البساتين',
  almazah: 'الماظة',
  ramses: 'رمسيس',
  'rod al-farag': 'رد الفارج',
  '6th of october': '6 أكتوبر',
  'sheikh zayed': 'الشيخ زايد',
  haram: 'الهرم',
  faisal: 'فيصل',
  'hadayek october': 'حدائق أكتوبر',
  'hadayek al-ahram': 'حدائق الأهرام',
  mohandessin: 'المهندسين',
  imbaba: 'إمبابة',
  dokki: 'الدقي',
  'giza district': 'حي الجيزة',
  warraq: 'الوراق',
  moneeb: 'المنيب',
  'boulaq dakrour': 'بولاق الدكرور',
  maryotaya: 'المريوطية',
  tersa: 'ترسا',
  'ard el-lewa': 'أرض اللواء',
  agouza: 'العجوزة',
  'saft el-laban': 'صفط اللبن',
  bashtil: 'بشتيل',
  hawamdeya: 'حوامدية',
  'al-giza': 'الجيزة',
  badrasheen: 'بدرشين',
  oseem: 'أوسيم',
  'kit kat': 'كيت كات',
  baragil: 'برج العرب',
  kerdasa: 'كرداسة',
  'abu rawash': 'أبو رواش',
  'dahab island': 'جزيرة الذهب',
  nahia: 'الناهية',
  mansuriyya: 'المنصورية',
  saf: 'صف',
  'el ayyat': 'العياط',
  'manial shiha': 'المنيل شيحة',
  dahshur: 'دهشور',
  zagazig: 'الزقازيق',
  '10th of ramadan': 'العاشر من رمضان',
  'minya al-qamh': 'منية القمح',
  bilbeis: 'بلبيس',
  faqous: 'فاقوس',
  'deyerb negm': 'ديرب نجم',
  'abu hammad': 'أبو حماد',
  'abu kabir': 'أبو كبير',
  'kafr saqr': 'كفر صقر',
  'mashtool al-souk': 'مشتول السوق',
  hihya: 'ههيا',
  husseiniya: 'الحسينية',
  alqnayat: 'القنايات',
  'new salhia': 'الصالحية الجديدة',
  'awlad saqr': 'أولاد صقر',
  qareen: 'قرين',
  ibrahemyah: 'إبراهيمية',
  mansura: 'المنصورة',
  'mit ghamr': 'ميت غمر',
  talkha: 'طلخا',
  'new mansoura': 'المنصورة الجديدة',
  sinbillawain: 'سنبلاوين',
  belqas: 'بلقاس',
  dikirnis: 'دكرنس',
  aga: 'أجا',
  shirbin: 'شربين',
  manzala: 'المنزلة',
  'minat al-nasr': 'مينات النصر',
  gamasa: 'جمصة',
  nabaruh: 'نبروه',
  'el matareya': 'المطرية',
  akhtab: 'أختب',
  'bani ubayd': 'بني عبيد',
  'el kordy': 'الكردي',
  'el gamaleya': 'الجمالية',
  'tama al-amdeed': 'تما العمدة',
  'mit slseel': 'ميت سلسيل',
  damanhour: 'دمنهور',
  'kafr al-dawwar': 'كفر الدوار',
  'etay al-barud': 'إيتاي البارود',
  'kom hamadah': 'كوم حمادة',
  badr: 'بدر',
  'abou homs': 'أبو حمص',
  'wadi al-natrun': 'وادي النطرون',
  delengat: 'دلنجات',
  'abuu al-matamer': 'أبو المطامير',
  shubrakhit: 'شبراخيت',
  rashid: 'رشيد',
  nubariyah: 'النوبارية',
  'hosh essa': 'هوش عيسى',
  mahmoudiyah: 'المحمودية',
  edko: 'إدكو',
  rahmaniya: 'الرحمانية',
  'minya city': 'مدينة المنيا',
  'new minya': 'المنيا الجديدة',
  malawi: 'ملاوي',
  samalut: 'سمالوط',
  'beni mazar': 'بني مزار',
  maghagha: 'مغاغة',
  'abu qurqas': 'أبو قرقاص',
  matay: 'متى',
  'deir mawas': 'دير مواس',
  adwa: 'أدفو',
  'shubra al-khaimah': 'شبرا الخيمة',
  banha: 'بنها',
  khosous: 'الخصوص',
  khanka: 'الخانكة',
  qalyub: 'القليوب',
  'qanater al-khairia': 'قناطر الخيرية',
  'shebin al-qanater': 'شبين القناطر',
  tookh: 'طوخ',
  qaha: 'قها',
  'kafr shukr': 'كفر شكر',
  sohag: 'سوهاج',
  akhmim: 'أخميم',
  girga: 'جرجا',
  tahta: 'طهطا',
  tama: 'تاما',
  baliana: 'بلينا',
  maragha: 'المراغة',
  monsha: 'المنشا',
  'new sohag': 'سوهاج الجديدة',
  juhaynah: 'جهينة',
  'dar el-salam': 'دار السلام',
  sakaltah: 'ساقلتة',
  alasirat: 'العسيرات',
  agami: 'العجمي',
  smoha: 'سموحة',
  seyouf: 'سيوف',
  miami: 'ميامي',
  'moharam bik': 'محرم بك',
  asafra: 'العصافرة',
  'al ibrahimiyyah': 'الإبراهيمية',
  mandara: 'مندرة',
  awayed: 'العوايد',
  'sidi beshr': 'سيدي بشر',
  'sidi gaber': 'سيدي جابر',
  laurent: 'لوران',
  nakheel: 'النخيل',
  'al hadrah': 'الهضبة',
  victoria: 'فيكتوريا',
  'abu qir': 'أبو قير',
  glim: 'جليم',
  fleming: 'فلمنج',
  bacchus: 'باخوس',
  amreya: 'العامرية',
  'san stefano': 'سان ستيفانو',
  'borg al-arab': 'برج العرب',
  maamoura: 'المعمورة',
  bolkly: 'البلكلي',
  'raml station': 'محطة الرمل',
  montazah: 'المنتزه',
  manshiyya: 'المنشية',
  'kafr abdo': 'كفر عبده',
  roushdy: 'روشدي',
  sporting: 'السبورتنج',
  gianaclis: 'جياناكليس',
  cleopatra: 'كليوباترا',
  wardian: 'وارديان',
  azarita: 'الأزاريطة',
  attarin: 'العطارين',
  'camp caesar': 'كامب سيزار',
  dekheila: 'الدخيلة',
  zezenia: 'الزيزينيا',
  schutz: 'شوتز',
  gomrok: 'الجمرك',
  tanta: 'طنطا',
  'mahalla al-kobra': 'المحلة الكبرى',
  zefta: 'زفتى',
  'kafr al-zayat': 'كفر الزيات',
  samanoud: 'سمنود',
  santa: 'سنطا',
  qutour: 'قطور',
  basyoun: 'بسيون',
  'asyut city': 'مدينة أسيوط',
  'new assiut': 'أسيوط الجديدة',
  fateh: 'فتح',
  dairut: 'دروة',
  qusiya: 'قوصية',
  manfalut: 'منفلوط',
  'abu teeg': 'أبو تيج',
  abnub: 'أبنوب',
  badari: 'بدري',
  sedfa: 'سدفا',
  ghanayem: 'الغنايم',
  'sahel selim': 'ساحل سليم',
  'new tiba': 'الطيبة الجديدة',
  'shebin al-koum': 'شبين الكوم',
  quesna: 'قويسنا',
  sadat: 'السادات',
  ashmon: 'أشمون',
  menouf: 'منوف',
  bagour: 'باجور',
  'berket al-sabaa': 'بركة السبع',
  tala: 'طلخا',
  shohadaa: 'الشهداء',
  'sers al-lyan': 'سرس الليان',
  'kafr al-sheikh city': 'مدينة كفر الشيخ',
  desouk: 'دسوق',
  bella: 'بيلا',
  qaleen: 'قلين',
  'sidi salem': 'سيدي سالم',
  baltim: 'بلطيم',
  hamoul: 'حمول',
  riyadh: 'رياض',
  fouh: 'فوه',
  motobas: 'موطبس',
  brolos: 'برلس',
  'abu tesht': 'أبو تشت',
  dishna: 'ديشنا',
  'el waqf': 'الوقف',
  farshut: 'فرشوط',
  'nag hammadi': 'نجع حمادي',
  naqada: 'نقادة',
  'new qena': 'قنا الجديدة',
  qena: 'قنا',
  qift: 'قفط',
  qus: 'قوص',
  'beni suef city': 'مدينة بني سويف',
  'new beni suef': 'بني سويف الجديدة',
  'al wasty': 'الواسطى',
  nasser: 'ناصر',
  beba: 'ببا',
  'al feshn': 'الفشن',
  ehnasia: 'إهناسيا',
  samasta: 'سمسطا',
  'damietta city': 'مدينة دمياط',
  'new damietta': 'دمياط الجديدة',
  'ras al-bar': 'رأس البر',
  fareskour: 'فارسكور',
  'kafr saad': 'كفر سعد',
  zarqa: 'الزرقا',
  'kafr al-bateekh': 'كفر البطيخ',
  'ezbet al-burj': 'عزبة البرج',
  saro: 'سارو',
  'el rodah': 'الروضة',
  'mit abughalb': 'ميت أبو غالب',
  'abu simbel': 'أبو سمبل',
  aswan: 'أسوان',
  daraw: 'دراو',
  edfu: 'إدفو',
  'kom ombo': 'كوم أمبو',
  'new aswan': 'أسوان الجديدة',
  'new tushka': 'تشكا الجديدة',
  nasr: 'نصر',
  'ismailia city': 'مدينة الإسماعيلية',
  fayed: 'فايد',
  'kantara west': 'القنطرة الغربية',
  'abu swear': 'أبو صوير',
  'tal al-kebeer': 'تل الكبير',
  qassaseen: 'قصاصين',
  'kantara east': 'القنطرة الشرقية',
  atssa: 'عتاقة',
  'fayoum city': 'مدينة الفيوم',
  'new fayoum': 'الفيوم الجديدة',
  tamiya: 'طامية',
  'yusuf al-sadiq': 'يوسف الصديق',
  ibshway: 'إبشواي',
  qurna: 'قرنة',
  luxor: 'الأقصر',
  armant: 'أرمنت',
  esna: 'إسنا',
  thebes: 'طيبة الجديدة',
  'ain sukhna': 'العين السخنة',
  'suez district': 'مدينة السويس',
  arbaeen: 'الأربعين',
  'faisal district': 'حي الفيصل',
  attaka: 'العتاقة',
  ganayen: 'جناين',
  'sharq district': 'حي الشرق',
  'port fouad': 'بورفؤاد',
  'zohour district': 'حي الزهور',
  'dawahy district': 'حي الضاوية',
  'manakh district': 'حي المناخ',
  'arab district': 'حي العرب',
  'ganoub district': 'حي الجنوب',
  'north coast': 'الساحل الشمالي',
  alamein: 'العلمين',
  'marsa matrouh': 'مرسى مطروح',
  dabaa: 'دبة',
  hammam: 'حمام',
  siwa: 'سيوة',
  'el arish 1': 'العريش 1',
  'el hassana': 'الحسنا',
  'sheikh zuweid': 'الشيخ زويد',
  'bir el-abd': 'بر العبد',
  nakhl: 'النخل',
  rafah: 'رفح',
  'shurtet el-qasima': 'شرطة القصيمة',
  'shurtet rumana': 'شرطة رومانا',
  hurghada: 'الغردقة',
  gouna: 'الجونة',
  safaga: 'سفاجا',
  'sahl hasheesh': 'سهل حشيش',
  'ras gharib': 'رأس غارب',
  qusair: 'القصير',
  'marsa alam': 'مرسى علم',
  'makadi bay': 'خليج مكادي',
  'soma bay': 'خليج سوما',
  'halayeb & shalateen': 'حلايب وشلاتين',
  kharga: 'الخارجة',
  balat: 'بلاط',
  dakhla: 'الداخلة',
  farafra: 'الفرافرة',
  baris: 'باريس',
  'abu redis': 'أبو رديس',
  dahab: 'دهب',
  'el tor': 'الطور',
  nuweiba: 'نويبع',
  'ras sedr': 'رأس سدر',
  'saint catherine': 'سانت كاترين',
  'sharm el-sheikh': 'شرم الشيخ',
  taba: 'طابا',
  // Categories
  vehicles: 'المركبات',
  'cars for sale': 'سيارات للبيع',
  'cars for rent': 'سيارات للإيجار',
  'cars spare parts': 'قطع غيار السيارات',
  'tires, batteries, oils & accessories': 'إطارات، بطاريات، زيوت وملحقات',
  'motorcycles & accessories': 'دراجات نارية وملحقاتها',
  'boats & watercraft': 'قوارب ومراكب',
  'heavy trucks, buses & other vehicles': 'شاحنات ثقيلة، حافلات ومركبات أخرى',
  properties: 'العقارات',
  'apartments for sale': 'شقق للبيع',
  'apartments for rent': 'شقق للإيجار',
  'villas for sale': 'فلل للبيع',
  'villas for rent': 'فلل للإيجار',
  'vacation homes for sale': 'منازل عطلات للبيع',
  'vacation homes for rent': 'منازل عطلات للإيجار',
  'commercial for sale': 'تجاري للبيع',
  'commercial for rent': 'تجاري للإيجار',
  'buildings & lands': 'مباني وأراضي',
  'mobiles & tablets': 'هواتف وأجهزة لوحية',
  'mobile phones': 'هواتف نقالة',
  tablets: 'أجهزة لوحية',
  'mobile & tablet accessories': 'ملحقات الهواتف والأجهزة اللوحية',
  'mobile numbers': 'أرقام الهواتف المتنقلة',
  'electronics & appliances': 'إلكترونيات وأجهزة منزلية',
  'home appliances': 'أجهزة منزلية',
  'computers & accessories': 'كمبيوترات وملحقاتها',
  'video games & consoles': 'ألعاب فيديو وأجهزة ألعاب',
  'cameras & photography': 'كاميرات وتصوير فوتوغرافي',
  'tv, audio & video': 'تلفزيون، صوت وفيديو',
  'furniture & decor': 'أثاث وديكور',
  bathroom: 'الحمام',
  bedroom: 'غرفة النوم',
  'dining room': 'غرفة الطعام',
  'fabrics, curtains & carpets': 'أقمشة، ستائر وسجاد',
  'garden & outdoor': 'الحديقة والهواء الطلق',
  'home decoration': 'ديكور المنزل',
  'kitchen & kitchenware': 'المطبخ وأدوات المطبخ',
  lightings: 'إضاءة',
  'living room': 'غرفة المعيشة',
  'other furniture': 'أثاث آخر',
  'business, industrial & agriculture': 'أعمال، صناعة وزراعة',
  'industrial equipment': 'معدات صناعية',
  'office furniture & equipment': 'أثاث ومعدات المكتب',
  construction: 'إنشاءات',
  'restaurants equipment': 'معدات المطاعم',
  'medical equipment': 'معدات طبية',
  agriculture: 'الزراعة',
  'whole business for sale': 'عمل كامل للبيع',
  'other business, industrial & agriculture': 'أعمال، صناعة وزراعة أخرى',
  jobs: 'الوظائف',
  'accounting, finance & banking': 'محاسبة، تمويل وبنوك',
  'customer service & call center': 'خدمة العملاء ومراكز الاتصال',
  'drivers & delivery': 'سائقين وتوصيل',
  designers: 'المصممين',
  engineering: 'الهندسة',
  hr: 'الموارد البشرية',
  sales: 'المبيعات',
  secretarial: 'السكرتارية',
  'guarding & security': 'حراسة وأمان',
  'it & telecom': 'تكنولوجيا المعلومات والاتصالات',
  'legal & lawyers': 'قانوني ومحامون',
  'management & consulting': 'إدارة واستشارات',
  'marketing and public relations': 'تسويق وعلاقات عامة',
  'medical, healthcare & nursing': 'طبي، رعاية صحية وتمريض',
  'Tourism, Travel & Hospitality': 'سياحة، سفر وضيافة',
  'workers & technicians': 'عمال وفنيين',
  'other job': 'وظائف أخرى',
  'fashion & beauty': 'أزياء وجمال',
  "men's clothing": 'ملابس رجالية',
  "women's clothing": 'ملابس نسائية',
  "men's accessories & personal care": 'إكسسوارات وعناية شخصية للرجال',
  "women's accessories, cosmetics & personal care":
    'إكسسوارات، مستحضرات تجميل وعناية شخصية للنساء',
  'pets & accessories': 'حيوانات أليفة وإكسسواراتها',
  'birds & pigeons': 'طيور وحمام',
  cats: 'القطط',
  dogs: 'الكلاب',
  'other pets & animals': 'حيوانات أليفة وحيوانات أخرى',
  'accessories & pet care products':
    'إكسسوارات ومنتجات رعاية الحيوانات الأليفة',
  'kids & babies': 'أطفال ورضع',
  'baby & mom healthcare': 'رعاية الطفل والأم',
  'baby clothing': 'ملابس الأطفال',
  'baby feeding tools': 'أدوات تغذية الأطفال',
  'cribs, strollers & carriers': 'سراير الأطفال، عربات الأطفال وحمالات الأطفال',
  'other baby items': 'أشياء أخرى للأطفال',
  toys: 'الألعاب',
  services: 'الخدمات',
  business: 'الأعمال',
  cars: 'السيارات',
  events: 'الفعاليات',
  education: 'التعليم',
  movers: 'شركات النقل',
  'health & beauty': 'الصحة والجمال',
  'home services & maintenance': 'خدمات المنزل والصيانة',
  medical: 'الطبي',
  pets: 'الحيوانات الأليفة',
  'other services': 'خدمات أخرى',
  'books, sports & hobbies': 'كتب، رياضة وهوايات',
  'antiques & collectibles': 'تحف ومقتنيات',
  bicycles: 'الدراجات',
  books: 'الكتب',
  'board & card games': 'ألعاب اللوح وألعاب البطاقات',
  'movies & audios': 'أفلام وصوتيات',
  'sports equipment': 'أدوات رياضية',
  'study tools': 'أدوات الدراسة',
  'tickets & vouchers': 'تذاكر وقسائم',
  luggage: 'الأمتعة',
  'other items': 'أشياء أخرى',
  // Branches

  'desktop-br': {
    'desktop computers': 'أجهزة كمبيوتر مكتبية',
    'laptop computers': 'أجهزة كمبيوتر محمولة',
    'computer accessories & spare parts': 'ملحقات الكمبيوتر وقطع الغيار'
  },
  'video-br': {
    'video game consoles': 'أجهزة ألعاب الفيديو',
    'video games & accessories': 'ألعاب الفيديو وملحقاتها'
  },
  // Types
  apartments: {
    apartment: 'شقة',
    duplex: 'دوبلكس',
    penthouse: 'بنتهاوس',
    studio: 'استوديو'
  },
  villas: {
    'stand alone villa': 'فيلا مستقلة',
    'town house': 'تاون هاوس',
    'twin house': 'توين هاوس'
  },
  vacation: {
    chalet: 'شاليه',
    'standalone villa': 'فيلا مستقلة',
    'twin house': 'توين هاوس',
    'town house': 'تاون هاوس',
    penthouse: 'بنتهاوس',
    duplex: 'دوبلكس',
    studio: 'استوديو'
  },
  'commercial-for': {
    retail: 'تجزئة',
    'office space': 'مساحة مكتبية',
    clinic: 'عيادة',
    'restaurant & cafe': 'مطعم وكافيه',
    factory: 'مصنع',
    'full commercial building': 'مبنى تجاري كامل',
    garage: 'جراج',
    warehouse: 'مستودع',
    'other commercial': 'تجاري آخر'
  },
  buildings: {
    residential: 'سكني',
    'any use': 'أي استخدام',
    commercial: 'تجاري',
    industrial: 'صناعي',
    agricultural: 'زراعي'
  },
  tires: {
    'tyres & sport rims': 'إطارات وحافات رياضية',
    'audio, video & camera devices': 'أجهزة الصوت والفيديو والكاميرا',
    'other exterior accessories': 'ملحقات خارجية أخرى',
    'other interior accessories': 'ملحقات داخلية أخرى',
    'emergency kit': 'طقم الطوارئ',
    'lamps & lighting accessories': 'المصابيح وملحقات الإضاءة',
    'sensors, alarm & security': 'الحساسات وأنظمة الإنذار والأمان',
    'seat covers & floor carpets': 'أغطية المقاعد والسجاد',
    batteries: 'بطاريات',
    oils: 'زيوت',
    'cleaning kit': 'طقم التنظيف',
    'air fresheners': 'معطرات الهواء'
  },
  'cars-spare': {
    'body parts': 'قطع الهيكل',
    'other mechanical parts': 'قطع ميكانيكية أخرى',
    headlights: 'مصابيح السيارة',
    'braking & suspension': 'نظام الفرامل والتعليق',
    'engines & transmissions': 'المحركات وناقلات الحركة',
    'sensors & electronic parts': 'الحساسات والأجزاء الإلكترونية',
    'salon & interior parts': 'أجزاء السيارة الداخلية',
    'original rims': 'حافات أصلية',
    'car glass': 'زجاج السيارة',
    'belts - filters': 'الأحزمة والفلاتر',
    'half cuts cars': 'سيارات نصف قطع'
  },
  boats: {
    boats: 'قوارب',
    yacht: 'يخت',
    'engines & spare parts': 'محركات وقطع غيار',
    'jet ski': 'جت سكي',
    other: 'آخر'
  },
  heavy: {
    'heavy trucks': 'شاحنات ثقيلة',
    'golf carts': 'عربات الجولف',
    buses: 'حافلات',
    caravans: 'كرافان',
    other: 'آخر'
  },
  mobile: {
    headsets: 'سماعات الرأس',
    'smart watches': 'ساعات ذكية',
    'chargers & cables': 'شواحن وكوابل',
    covers: 'أغطية الهاتف',
    'power banks': 'بنوك الطاقة',
    'memory cards': 'بطاقات الذاكرة',
    other: 'آخر'
  },
  tv: {
    televisions: 'أجهزة التلفاز',
    'dvd - home theater': 'أقراص دي في دي وأنظمة المسرح المنزلي',
    'home audio': 'أجهزة الصوت المنزلي',
    'mp3 players - portable audio': 'مشغلات MP3 وأجهزة الصوت المحمولة',
    'satellite tv receivers': 'أجهزة استقبال التلفاز الفضائي'
  },
  appliances: {
    'refrigerators - freezers': 'ثلاجات وفريزر',
    'ovens - microwaves': 'أفران وميكروويف',
    dishwashers: 'غسالات الأطباق',
    'cooking tools': 'أدوات الطهي',
    'washers - dryers': 'غسالات ومجففات',
    'water coolers & kettles': 'مبردات المياه والغلايات',
    'air conditioners & fans': 'مكيفات الهواء والمراوح',
    'cleaning appliances': 'أجهزة التنظيف',
    heaters: 'سخانات',
    'other home appliances': 'أجهزة منزلية أخرى'
  },
  cameras: {
    cameras: 'كاميرات',
    'security cameras': 'كاميرات الأمان',
    'camera accessories': 'ملحقات الكاميرا',
    'binoculars - telescopes': 'المناظير والتلسكوبات'
  },
  furniture: {
    bathroom: 'الحمام',
    bedroom: 'غرفة النوم',
    'dining room': 'غرفة الطعام',
    'fabrics - curtains - carpets': 'الأقمشة والستائر والسجاد',
    'garden - outdoor': 'الحديقة والهواء الطلق',
    'home decoration': 'ديكور المنزل',
    'kitchen - kitchenware': 'المطبخ وأدواته',
    'lighting tools': 'أدوات الإضاءة',
    'living room': 'غرفة المعيشة',
    'other furniture': 'أثاث آخر'
  },
  bathroomIn: {
    'shower room - tub': 'غرفة الاستحمام - حوض الاستحمام',
    sink: 'الحوض',
    'water mixers - shower heads': 'خلاطات المياه - رؤوس الدش',
    'mirrors - shelves - other accessories': 'المرايا - الرفوف - ملحقات أخرى',
    'full bathroom': 'حمام كامل',
    toilet: 'المرحاض',
    towels: 'المناشف',
    other: 'آخر'
  },
  accounting: {
    'general accountant': 'محاسب عام',
    'accounts receivable': 'الحسابات القابلة للدفع',
    'finance manager': 'مدير التمويل',
    'tax accountant': 'محاسب الضرائب',
    'cost accountant': 'محاسب التكاليف',
    auditor: 'مراجع',
    'accounts payable': 'الحسابات المستحقة للدفع',
    'types manager': 'مدير الأنواع',
    other: 'آخر'
  },
  engineeringIn: {
    architectural: 'هندسة معمارية',
    civil: 'هندسة مدنية',
    mechanical: 'هندسة ميكانيكية',
    electrical: 'هندسة كهربائية',
    chemical: 'هندسة كيميائية',
    electronics: 'هندسة إلكترونية',
    agricultural: 'هندسة زراعية',
    computer: 'هندسة حاسوب',
    other: 'آخر'
  },
  designersIn: {
    'graphic designer': 'مصمم جرافيك',
    'interior designer': 'مصمم داخلي',
    'video creator - animation': 'منتج فيديو - رسوم متحركة',
    '(ux) designer': 'مصمم تجربة مستخدم',
    'fashion designer': 'مصمم أزياء',
    other: 'آخر'
  },
  hrIn: {
    general: 'الموارد البشرية العامة',
    recruitment: 'التوظيف',
    'hr manager': 'مدير الموارد البشرية',
    personnel: 'الشؤون الشخصية',
    admin: 'الإدارة',
    other: 'آخر'
  },
  tourism: {
    housekeeping: 'العمالة المنزلية',
    chef: 'الطباخ',
    barista: 'باريستا',
    waiter: 'النادل',
    receptionist: 'الاستقبال',
    'restaurant-hotel manager': 'مدير مطعم أو فندق',
    'ticketing - reservations': 'الحجز والتذاكر',
    captain: 'الكابتن',
    host: 'المضيف',
    busboy: 'النادل المساعد',
    steward: 'مضيف الطائرة',
    'travel agent': 'وكيل السفر',
    baker: 'الخباز',
    lifeguard: 'حارس السباحة',
    other: 'آخر'
  },
  medicalIN: {
    pharmacist: 'صيدلي',
    dentist: 'طبيب أسنان',
    nursing: 'تمريض',
    dermatologist: 'طبيب الجلدية',
    dietician: 'أخصائي تغذية',
    vet: 'طبيب بيطري',
    radiologist: 'أخصائي الأشعة',
    ent: 'أخصائي الأنف والأذن والحنجرة',
    'general doctor': 'طبيب عام',
    internist: 'طبيب باطني',
    ophthalmologist: 'طبيب عيون',
    pediatrician: 'طبيب أطفال',
    psychologist: 'عالم نفس',
    other: 'آخر'
  },
  salesIn: {
    'field sales': 'مبيعات في الميدان',
    retail: 'تجزئة',
    telesales: 'المبيعات عبر الهاتف',
    'sales manager': 'مدير المبيعات'
  },
  bedroomIn: {
    'full bedroom': 'غرفة نوم كاملة',
    bed: 'سرير',
    'children bedroom': 'غرفة نوم للأطفال',
    mattresses: 'فرش السرير',
    'bedding set': 'مجموعة الفراش',
    closets: 'خزائن',
    nightstands: 'طاولات الليل',
    pillows: 'وسائد',
    other: 'آخر'
  },
  dining: {
    'full dining room': 'غرفة طعام كاملة',
    'dining tables': 'طاولات الطعام',
    'dining buffet / sideboards': 'بوفيهات الطعام / خزانات جانبية',
    'dining chairs': 'كراسي الطعام',
    other: 'آخر'
  },
  fabrics: {
    carpets: 'السجاد',
    curtains: 'الستائر',
    fabrics: 'الأقمشة'
  },
  garden: {
    'garden furniture': 'أثاث الحديقة',
    'garden umbrella': 'مظلة الحديقة',
    'plants & flowers': 'النباتات والزهور',
    'pool systems': 'أنظمة البيت السباحة',
    'watering tools': 'أدوات الري',
    'garden grill': 'الشواية في الحديقة',
    other: 'آخر'
  },
  decoration: {
    'wallpapers - frames': 'ورق الجدران - الإطارات',
    vases: 'الزهور',
    mirrors: 'المرايا',
    'wall clocks': 'ساعات الحائط',
    'candle decorations': 'ديكورات الشموع',
    'artificial flowers': 'زهور صناعية',
    'wall stickers': 'ملصقات الحائط',
    baskets: 'السلال',
    'other home decoration': 'ديكور المنزل الآخر'
  },
  kitchen: {
    'utensils - cooking tools': 'أدوات المطبخ - أدوات الطهي',
    'full kitchen': 'مطبخ كامل',
    'cups - mugs - glass': 'الكؤوس - المزاجين - الأكواب الزجاجية',
    'spoons - knives - forks': 'ملاعق - سكاكين - شوك',
    'plates - bowl': 'الصحون - السلطانيات',
    'storage boxes': 'صناديق التخزين',
    'cake molds & cookie cutters': 'قوالب الكيك وقوالب الكوكيز',
    other: 'آخر'
  },
  lightingsIN: {
    'chandelier & pendant lamp': 'ثريات ومصابيح الباندانت',
    lamps: 'المصابيح',
    'lampshade & desk lamp': 'ظلال اللمبة ومصباح الطاولة',
    'emergency lights': 'مصابيح الطوارئ',
    'led tapes': 'أشرطة الإضاءة LED',
    other: 'آخر'
  },
  living: {
    'full living room': 'غرفة المعيشة كاملة',
    'chairs & couches': 'الكراسي والأرائك',
    tables: 'الطاولات',
    'bookshelf & media cabinets': 'رفوف الكتب وخزائن الوسائط',
    'bean bag': 'كيس الفول',
    other: 'آخر'
  },
  women: {
    dresses: 'الفساتين',
    'pullover - coats - jackets': 'بلوفر - معاطف - جاكيتات',
    'wedding apparel': 'ملابس الزفاف',
    'blouse - t-shirts - tops': 'بلوزات - تيشيرتات - قمم',
    'trousers - leggings - jeans': 'سراويل - ليغينغز - جينز',
    nightwear: 'ملابس النوم',
    'sweatshirts - sportswear': 'سترات رياضية - ملابس رياضية',
    swimwear: 'ملابس السباحة',
    other: 'آخر'
  },
  men: {
    'pullover - coats - jackets': 'بلوفر - معاطف - جاكيتات',
    'sweatshirts & cardigans': 'سترات رياضية وكارديجانات',
    suits: 'البدل',
    'shirts - t-shirts': 'القمصان والتيشيرتات',
    sportswear: 'ملابس رياضية',
    'trousers & jeans': 'السراويل والجينز',
    nightwear: 'ملابس النوم',
    swimwear: 'ملابس السباحة',
    other: 'آخر'
  },
  'women-acc': {
    shoes: 'الأحذية',
    'handbags - backpacks': 'حقائب اليد - حقائب الظهر',
    'hair dryers - styling tools': 'مجففات الشعر - أدوات التصفيف',
    watches: 'الساعات',
    jewelry: 'المجوهرات',
    perfumes: 'العطور',
    'hair removal devices': 'أجهزة إزالة الشعر',
    'hair care': 'العناية بالشعر',
    'creams - oils': 'الكريمات - الزيوت',
    makeup: 'مستحضرات التجميل',
    sunglasses: 'النظارات الشمسية',
    wallets: 'المحافظ',
    'belts - tights': 'الأحزمة - الجوارب النسائية',
    'gloves - scarves - hats': 'القفازات - الأوشحة - القبعات',
    other: 'آخر'
  },
  'men-acc': {
    watches: 'الساعات',
    shoes: 'الأحذية',
    sunglasses: 'النظارات الشمسية',
    perfumes: 'العطور',
    shavers: 'الحلاقة',
    ties: 'الربطات',
    'bags - backpacks': 'حقائب - حقائب الظهر',
    wallets: 'المحافظ',
    'hats - caps': 'القبعات - القبعات الرياضية',
    'hair care': 'العناية بالشعر',
    'creams - oils': 'الكريمات - الزيوت',
    'belts-socks': 'أحزمة - جوارب',
    'gloves - scarves - hats': 'القفازات - الأوشحة - القبعات',
    other: 'آخر'
  },
  'other-pets': {
    turtles: 'سلاحف',
    sheep: 'أغنام',
    fish: 'أسماك',
    goats: 'ماعز',
    rabbits: 'أرانب',
    horses: 'خيول',
    hamsters: 'همستر',
    cows: 'أبقار',
    camels: 'جمال',
    other: 'آخر'
  },
  'accessories-pet': {
    'birds cage': 'قفص الطيور',
    aquarium: 'حوض السمك',
    'pet care products': 'منتجات رعاية الحيوانات الأليفة',
    'pet carrier': 'حامل الحيوانات الأليفة',
    'animal food': 'طعام الحيوانات',
    'litter box': 'صندوق التراب',
    'dog leash': 'حبل المشي للكلاب',
    'food - water bowl': 'وعاء الطعام - الماء',
    'other item': 'عنصر آخر'
  },
  'baby-mom': {
    diaper: 'حفاض',
    'sterilizers tools': 'أدوات التعقيم',
    'bath tub': 'حوض الاستحمام',
    'toilet training seat': 'مقعد تدريب المرحاض',
    'silicone nipple protectors': 'حاميات السيليكون للحلمة',
    skincare: 'منتجات العناية بالبشرة',
    'shampoo - soaps': 'شامبو - صابون',
    other: 'آخر'
  },
  'baby-clothingIn': {
    jacket: 'جاكيت',
    shoes: 'أحذية',
    't-shirt - blouse': 'تيشيرت - بلوزة',
    pants: 'بنطلون',
    'wedding clothes': 'ملابس الزفاف',
    sleepwear: 'ملابس النوم',
    swimwear: 'ملابس السباحة',
    slippers: 'شباشب',
    underwear: 'ملابس داخلية',
    'other clothes - accessories': 'ملابس وإكسسوارات أخرى'
  },
  'baby-feeding': {
    'breast pumps': 'مضخات الحليب',
    'feeding bottle': 'زجاجة الرضاعة',
    pacifier: 'مصاصة',
    cups: 'أكواب',
    'plates & bowls': 'صحون وأطباق',
    other: 'آخر'
  },
  cribs: {
    'stroller & pushchair': 'عربة الأطفال والمشاية',
    cribs: 'سراير الأطفال',
    'car seat': 'مقعد السيارة للأطفال',
    'baby carriers': 'حاملات الأطفال',
    walkers: 'مشاية الأطفال',
    'baby tools bag': 'حقيبة أدوات الرضاعة',
    other: 'آخر'
  },
  toysIn: {
    'vehicles toys': 'ألعاب المركبات',
    'development - educational toys': 'ألعاب التنمية والتعليم',
    'action figures': 'شخصيات حركية',
    'musical baby toys': 'ألعاب موسيقية للأطفال',
    'crib toys': 'ألعاب السرير',
    'other toys': 'ألعاب أخرى'
  },
  antiques: {
    'old currencies & medals': 'عملات وميداليات قديمة',
    antiques: 'تحف',
    collectibles: 'قطع جمعية',
    'pens & writing instruments': 'أقلام وأدوات الكتابة',
    art: 'فن',
    other: 'آخر'
  },
  bicyclesIn: {
    bicycles: 'دراجات',
    'children’s bikes': 'دراجات الأطفال',
    'accessories - spare parts': 'إكسسوارات وقطع غيار',
    other: 'آخر'
  },
  movies: {
    'music cds & cassettes': 'أقراص وكاسيتات الموسيقى',
    'dvd movies': 'أفلام DVD',
    other: 'آخر'
  },
  sports: {
    'treadmills - exercise bikes': 'مشايات - دراجات تمرين',
    'dumbbell - bars': 'أثقال - قضبان',
    'water sports': 'رياضات مائية',
    'tennis & racquet sports': 'تنس ورياضات الراكيت',
    'billiards - ping pong': 'بلياردو - بينج بونج',
    balls: 'كرات',
    'fishing tools': 'أدوات الصيد',
    'camping tools': 'أدوات التخييم',
    golf: 'جولف',
    other: 'آخر'
  },
  study: {
    calculators: 'آلات حاسبة',
    'drawing tools': 'أدوات الرسم',
    stationery: 'قرطاسية',
    whiteboard: 'سبورة بيضاء',
    'paper products': 'منتجات ورقية',
    other: 'آخر'
  },
  tickets: {
    'concerts - events': 'تذاكر الحفلات والفعاليات',
    'shopping vouchers': 'قسائم التسوق',
    'travel offers': 'عروض السفر',
    other: 'آخر'
  },
  agricultureIn: {
    'farm machinery': 'آلات زراعية',
    crops: 'محاصيل',
    seeds: 'بذور',
    fertilizers: 'أسمدة',
    pesticides: 'مبيدات',
    other: 'آخر'
  },
  industrial: {
    'production lines': 'خطوط الإنتاج',
    generators: 'مولدات',
    'safety equipments': 'معدات السلامة',
    'industrial cleaning machines': 'آلات التنظيف الصناعي',
    'other industrial equipments': 'معدات صناعية أخرى'
  },
  constructionIn: {
    'building materials & supplies': 'مواد ولوازم البناء',
    'light equipment & tools': 'معدات وأدوات خفيفة',
    'heavy equipment & parts': 'معدات ثقيلة وقطع غيار',
    other: 'آخر'
  },
  office: {
    'office furniture': 'أثاث المكاتب',
    photocopier: 'آلة التصوير',
    'office stationery': 'قرطاسية المكتب',
    'phones & faxes': 'هواتف وفاكسات',
    shredder: 'ممزق ورق',
    other: 'آخر'
  },
  restaurants: {
    'cooking equipment': 'أدوات الطهي',
    'restaurant furniture': 'أثاث المطاعم',
    'freezers & refrigerators': 'ثلاجات وفريزرات',
    'plates - tableware': 'صحون وأواني طعام',
    'cleaning tools': 'أدوات التنظيف',
    other: 'آخر'
  },
  businessIn: {
    'graphic design': 'تصميم جرافيك',
    'website creation': 'إنشاء مواقع الويب',
    'business legal setup': 'تأسيس قانوني للأعمال',
    'printing services': 'خدمات الطباعة',
    marketing: 'تسويق',
    accounting: 'محاسبة',
    'it repair': 'إصلاح تقنية المعلومات',
    'translations & copywriting': 'ترجمة وكتابة نصوص',
    recruitment: 'توظيف',
    'other business services': 'خدمات أعمال أخرى'
  },
  carsIn: {
    'car mechanic - electrician': 'فني سيارات - كهربائي',
    'body repair services': 'خدمات إصلاح الهيكل',
    'car rescue winch': 'ونش إنقاذ السيارات',
    'car cleaning': 'تنظيف السيارات',
    'car key services': 'خدمات المفاتيح للسيارات',
    'other car services': 'خدمات السيارات الأخرى'
  },
  health: {
    'hairdressing - barber': 'تصفيف الشعر - حلاقة',
    'sport coach': 'مدرب رياضي',
    'tailor - dressmaking': 'خياط - تفصيل الملابس',
    'make up artists': 'فناني المكياج',
    'other health & beauty': 'صحة وجمال آخر'
  },
  'home-services': {
    'electronic home devices repair': 'إصلاح الأجهزة الإلكترونية المنزلية',
    'wall painting': 'دهان الجدران',
    'other home services': 'خدمات المنزل الأخرى',
    'electric services': 'خدمات الكهرباء',
    'interior design': 'تصميم الديكور الداخلي',
    plumbing: 'أعمال السباكة',
    'satellite - aerial': 'صحن - هوائي',
    carpentry: 'أعمال النجارة',
    alumetal: 'ألمونيوم ومعادن',
    'ceramic installation': 'تركيب السيراميك',
    housekeeping: 'خدمات التنظيف والصيانة',
    'upholstery - curtains': 'تنجيد وستائر',
    nannies: 'جليسات الأطفال',
    'garden services': 'خدمات الحدائق',
    'pest control': 'مكافحة الآفات',
    cooking: 'خدمات الطهي',
    'laundry - dry cleaning': 'خدمات الغسيل والتنظيف الجاف',
    'security services': 'خدمات الأمان'
  },
  medicalIn: {
    nursing: 'تمريض',
    physiotherapist: 'علاج طبيعي',
    dentistry: 'طب الأسنان',
    psychiatry: 'طب نفسي',
    internist: 'طبيب باطني',
    'dietitian and nutrition': 'تغذية وتغذية',
    laboratory: 'مختبر',
    dermatology: 'طب الجلدية',
    ent: 'أنف وأذن وحنجرة',
    'heart - blood vessels': 'قلب وأوعية دموية',
    radiology: 'أشعة',
    'surgery services': 'خدمات الجراحة',
    'obstetrics and gynecology': 'طب النساء والتوليد',
    orthopedics: 'طب العظام',
    pediatrics: 'طب الأطفال',
    'plastic surgery': 'جراحة التجميل',
    other: 'آخر'
  },
  moversIn: {
    'internal moving': 'التحرك الداخلي',
    'international shipping': 'الشحن الدولي'
  },
  petsIn: {
    'dog trainers': 'مدربين للكلاب',
    'pet groomers - vets': 'مصففون للحيوانات الأليفة - أطباء بيطريين',
    'other pets services': 'خدمات الحيوانات الأليفة الأخرى'
  },
  educationIn: {
    language: 'لغة',
    computer: 'حاسوب',
    music: 'موسيقى',
    driving: 'قيادة',
    drawing: 'رسم',
    cooking: 'طهي',
    dance: 'رقص',
    'other classes': 'فصول أخرى'
  },
  'video-game': {
    playstation: 'بلايستيشن',
    xbox: 'إكس بوكس',
    'handheld game': 'لعبة محمولة',
    consoles: 'أجهزة اللعب',
    wii: 'وي',
    other: 'آخر'
  },
  'video-games': {
    'playstation games': 'ألعاب بلايستيشن',
    joysticks: 'أجهزة التحكم',
    'online games': 'ألعاب عبر الإنترنت',
    'xbox games': 'ألعاب إكس بوكس',
    'computer games': 'ألعاب الحاسوب',
    'wii games': 'ألعاب وي',
    other: 'آخر'
  },
  'computer-acc': {
    'router / switch': 'جهاز التوجيه / التبديل',
    'printer / scanner': 'طابعة / ماسح ضوئي',
    'hard disk / flash memory': 'قرص صلب / ذاكرة فلاش',
    'mouse / keyboard, monitors': 'فأرة / لوحة مفاتيح ، شاشات',
    'motherboard / processor, ram, bags':
      'لوحة أم / معالج ، ذاكرة الوصول العشوائي ، حقائب',
    'power supply': 'مزود الطاقة',
    'cleaning kit': 'طقم التنظيف',
    'other item': 'عنصر آخر'
  },
  // Brands

  videoGamesB: {
    sony: 'سوني',
    microsoft: 'مايكروسوفت',
    nintendo: 'نينتندو',
    other: 'آخر'
  },
  mobileNumberB: {
    vodafone: 'فودافون',
    we: 'وي',
    orange: 'أورانج',
    etisalat: 'اتصالات'
  },
  tvBrands: {
    lg: 'إل جي',
    sony: 'سوني',
    samsung: 'سامسونج',
    panasonic: 'باناسونيك',
    bosch: 'بوش',
    tornado: 'تورنيدو',
    braun: 'براون',
    ariston: 'أريستون',
    beko: 'بيكو',
    alaska: 'ألاسكا',
    electrostar: 'إلكتروستار',
    unionaire: 'يونيون إير',
    'white whale': 'وايت ويل',
    'general electric': 'جنرال إلكتريك',
    'white point': 'وايت بوينت',
    philips: 'فيليبس',
    toshiba: 'توشيبا',
    fresh: 'فريش',
    sharp: 'شارب',
    sanyo: 'سانيو',
    kenwood: 'كينوود',
    daewoo: 'ديوو',
    kiriazi: 'كيريازي',
    zanussi: 'زانوسي',
    uniontech: 'يونيون تك',
    hitachi: 'هيتاشي',
    universal: 'يونيفرسال',
    'other brand': 'علامة تجارية أخرى'
  },
  carsBrands: {
    nissan: 'نيسان',
    toyota: 'تويوتا',
    kia: 'كيا',
    chevrolet: 'شيفروليه',
    jeep: 'جيب',
    jetour: 'جيتور',
    mitsubishi: 'ميتسوبيشي',
    fiat: 'فيات',
    peugeot: 'بيجو',
    hyundai: 'هيونداي',
    chery: 'شيري',
    opel: 'أوبل',
    bmw: 'بي إم دبليو',
    'mercedes-benz': 'مرسيدس بنز',
    daewoo: 'ديوو',
    mg: 'إم جي',
    daihatsu: 'دايهاتسو',
    skoda: 'شكودا',
    subaru: 'سوبارو',
    suzuki: 'سوزوكي',
    lada: 'لادا',
    volkswagen: 'فولكسفاغن',
    renault: 'رينو',
    citroen: 'سيتروين',
    honda: 'هوندا',
    'land rover': 'لاند روفر',
    ford: 'فورد',
    seat: 'سيات',
    audi: 'أودي',
    'alfa-romeo': 'ألفا روميو',
    byd: 'بي واي دي',
    'ssang-yong': 'سانج يونج',
    geely: 'جيلي',
    speranza: 'سبرانزا',
    porsche: 'بورش',
    mini: 'ميني',
    jac: 'جاك',
    changan: 'تشانجان',
    mazda: 'مازدا',
    proton: 'بروتون',
    volvo: 'فولفو',
    dodge: 'دودج',
    jaguar: 'جاكوار',
    haval: 'هافال',
    chrysler: 'كرايسلر',
    tesla: 'تسلا',
    isuzu: 'ايسوزو',
    'other brands': 'علامات تجارية أخرى'
  },
  motorCyclesB: {
    dayun: 'دايون',
    sym: 'سيم',
    benelli: 'بينيلي',
    bajaj: 'باجاج',
    honda: 'هوندا',
    halawa: 'حلاوة',
    vespa: 'فيسبا',
    'tok tok': 'توك توك',
    kymco: 'كايمكو',
    suzuki: 'سوزوكي',
    yamaha: 'ياماها',
    egos: 'إيجوس',
    kawasaki: 'كاواساكي',
    bmw: 'بي إم دبليو',
    'harley davidson': 'هارلي ديفيدسون',
    piaggio: 'بياجيو',
    peugeot: 'بيجو',
    ducati: 'دوكاتي',
    ktm: 'كيه تي إم',
    'other brands': 'علامات تجارية أخرى'
  },
  tabletsB: {
    'apple - iphone': 'آبل - آيفون',
    samsung: 'سامسونج',
    xiaomi: 'شاومي',
    oppo: 'أوبو',
    realme: 'ريلمي',
    huawei: 'هواوي',
    infinix: 'إنفينكس',
    nokia: 'نوكيا',
    vivo: 'فيفو',
    honor: 'هونر',
    'one plus': 'وان بلس',
    google: 'جوجل',
    sony: 'سوني',
    motorola: 'موتورولا',
    tecno: 'تكنو',
    lenovo: 'لينوفو',
    htc: 'إتش تي سي',
    zte: 'زد تي إي',
    lg: 'إل جي',
    alcatel: 'ألكاتيل',
    'other brand': 'علامة تجارية أخرى'
  },
  computersB: {
    hp: 'إتش بي',
    dell: 'ديل',
    lenovo: 'لينوفو',
    apple: 'آبل',
    asus: 'أسوس',
    samsung: 'سامسونج',
    acer: 'أيسر',
    toshiba: 'توشيبا',
    msi: 'إم إس آي',
    microsoft: 'مايكروسوفت',
    fujitsu: 'فوجيتسو',
    sony: 'سوني',
    lg: 'إل جي',
    ibm: 'آي بي إم',
    other: 'آخر'
  }
}

let types = []
let branch = []
let brands = []

function allSubCategories (subCategory) {
  switch (replaceChar(subCategory)) {
    case 'apartments-for-sale':
    case 'apartments-for-rent':
      types = allUrls('apartments', 0, 1)
      brands = []
      branch = []
      break
    case 'villas-for-sale':
    case 'villas-for-rent':
      types = allUrls('villas', 0, 1)
      brands = []
      branch = []
      break
    case 'vacation-homes-for-sale':
    case 'vacation-homes-for-rent':
      types = allUrls('vacation', 0, 1)
      brands = []
      branch = []
      break
    case 'commercial-for-sale':
    case 'commercial-for-rent':
      branch = []
      brands = []
      types = allUrls('commercial-for', 0, 1)
      break
    case 'buildings-lands':
      branch = []
      brands = []
      types = allUrls('buildings', 0, 1)
      break

    case 'tires-batteries-oils-accessories':
      branch = []
      brands = []
      types = allUrls('tires', 0, 1)
      break
    case 'cars-spare-parts':
      types = allUrls('cars-spare', 0, 1)
      branch = []
      brands = allUrls('carsBrands', 0, 1)
      break
    case 'cars-for-rent':
    case 'cars-for-sale':
      brands = allUrls('carsBrands', 0, 1)
      types = []
      branch = []
      break
    case 'motorcycles-accessories':
      brands = allUrls('motorCyclesB', 0, 1)
      types = []
      branch = []
      break

    case 'boats-watercraft':
      brands = []
      types = allUrls('boats', 0, 1)
      branch = []
      break

    case 'heavy-trucks-buses-other-vehicles':
      brands = []
      types = allUrls('heavy', 0, 1)
      branch = []
      break

    case 'mobile-phones':
    case 'tablets':
      brands = allUrls('tabletsB', 0, 1)
      types = []
      branch = []
      break
    case 'mobile-numbers':
      brands = allUrls('mobileNumberB', 0, 1)
      types = []
      branch = []
      break
    case 'mobile-tablet-accessories':
      branch = []
      brands = []
      types = allUrls('mobile', 0, 1)
      break

    case 'tv-audio-video':
      brands = allUrls('tvBrands', 0, 1)
      types = allUrls('tv', 0, 1)
      branch = []
      break
    case 'home-appliances':
      types = allUrls('appliances', 0, 1)
      brands = allUrls('tvBrands', 0, 1)
      branch = []
      break
    case 'computers-accessories':
      brands = allUrls('computersB', 0, 1)
      types = []

      branch = allUrls('desktop-br', 0, 1)
      break
    case 'video-games-consoles':
      branch = allUrls('video-br', 0, 1)

      brands = allUrls('videoGamesB', 0, 1)

      types = []
      break
    case 'cameras-photography':
      types = allUrls('cameras', 0, 1)
      brands = []
      branch = []
      break

    case 'furniture-decor':
      types = allUrls('furniture', 0, 1)
      brands = []
      branch = []
      break
    case 'bathroom':
      types = allUrls('bathroomIn', 0, 1)
      brands = []
      branch = []
      break

    case 'accounting-finance-banking':
      types = allUrls('accounting', 0, 1)

      branch = []
      brands = []
      break
    case 'engineering':
      types = allUrls('engineeringIn', 0, 1)
      brands = []
      branch = []
      break
    case 'designers':
      types = allUrls('designersIn', 0, 1)
      branch = []
      brands = []
      break
    case 'hr':
      types = allUrls('hrIn', 0, 1)
      branch = []
      brands = []
      break
    case 'tourism-travel-hospitality':
      types = allUrls('tourism', 0, 1)
      branch = []
      brands = []
      break
    case 'medical-healthcare-nursing':
      types = allUrls('medicalIN', 0, 1)
      branch = []
      brands = []
      break
    case 'sales':
      types = allUrls('salesIn', 0, 1)
      branch = []
      brands = []
      break

    case 'bedroom':
      types = allUrls('bedroomIn', 0, 1)
      branch = []
      brands = []
      break
    case 'dining-room':
      types = allUrls('dining', 0, 1)
      branch = []
      brands = []
      break

    case 'fabrics-curtains-carpets':
      types = allUrls('fabrics', 0, 1)
      branch = []
      brands = []
      break

    case 'garden-outdoor':
      types = allUrls('garden', 0, 1)
      branch = []
      brands = []
      break
    case 'home-decoration':
      types = allUrls('decoration', 0, 1)
      branch = []
      brands = []
      break
    case 'kitchen-kitchenware':
      types = allUrls('kitchen', 0, 1)
      brands = []
      branch = []
      break
    case 'lightings':
      types = allUrls('lightingsIN', 0, 1)
      branch = []
      brands = []
      break
    case 'living-room':
      types = allUrls('living', 0, 1)
      branch = []
      brands = []
      break

    case 'other-items':
    case 'luggage':
    case 'books':
    case 'board-card-games':
    case 'events':
    case 'other-services':
    case 'other-baby-items':
    case 'birds-pigeons':
    case 'dogs':
    case 'cats':
    case 'workers-technicians':
    case 'marketing-and-public-relations':
    case 'management-consulting':
    case 'legal-lawyers':
    case 'it-telecom':
    case 'guarding-security':
    case 'drivers-delivery':
    case 'customer-service-call-center':
    case 'other-business-industrial-agriculture':
    case 'whole-business-for-sale':
    case 'medical-equipment':
    case 'other-furniture':
      types = []
      branch = []
      brands = []
      break

    case 'women-clothing':
      types = allUrls('women', 0, 1)
      brands = []
      branch = []
      break
    case 'men-clothing':
      types = allUrls('men', 0, 1)
      brands = []
      branch = []
      break
    case 'women-accessories-cosmetics-personal-care':
      types = allUrls('women-acc', 0, 1)
      brands = []
      branch = []
      break
    case 'men-accessories-personal-care':
      types = allUrls('men-acc', 0, 1)
      branch = []
      brands = []
      break

    case 'other-pets-animals':
      types = allUrls('other-pets', 0, 1)
      branch = []
      brands = []
      break
    case 'accessories-pet-care-products':
      types = allUrls('accessories-pet', 0, 1)
      branch = []
      brands = []
      break

    case 'baby-mom-healthcare':
      types = allUrls('baby-mom', 0, 1)
      branch = []
      brands = []
      break
    case 'baby-clothing':
      types = allUrls('baby-clothingIn', 0, 1)
      branch = []
      brands = []
      break
    case 'baby-feeding-tools':
      types = allUrls('baby-feeding', 0, 1)
      branch = []
      brands = []
      break
    case 'cribs-strollers-carriers':
      types = allUrls('cribs', 0, 1)
      branch = []
      brands = []
      break
    case 'toys':
      types = allUrls('toysIn', 0, 1)
      brands = []
      branch = []
      break

    case 'antiques-collectibles':
      types = allUrls('antiques', 0, 1)
      branch = []
      brands = []
      break
    case 'bicycles':
      types = allUrls('bicyclesIn', 0, 1)
      branch = []
      brands = []
      break
    case 'movies-audios':
      types = allUrls('movies', 0, 1)
      branch = []
      brands = []
      break
    case 'sports-equipment':
      types = allUrls('sports', 0, 1)
      branch = []
      brands = []
      break
    case 'study-tools':
      types = allUrls('study', 0, 1)
      branch = []
      brands = []
      break
    case 'tickets-vouchers':
      types = allUrls('tickets', 0, 1)
      branch = []
      brands = []
      break

    case 'agriculture':
      branch = []
      types = allUrls('agricultureIn', 0, 1)
      brands = []
      break
    case 'construction':
      types = allUrls('constructionIn', 0, 1)
      brands = []
      branch = []
      break
    case 'industrial-equipment':
      types = allUrls('industrial', 0, 1)
      brands = []
      branch = []
      break
    case 'office-furniture-equipment':
      types = allUrls('office', 0, 1)
      brands = []
      branch = []
      break
    case 'restaurants-equipment':
      types = allUrls('restaurants', 0, 1)
      brands = []
      branch = []
      break

    case 'business':
      types = allUrls('businessIn', 0, 1)
      brands = []
      branch = []
      break
    case 'cars':
      types = allUrls('carsIn', 0, 1)
      brands = []
      branch = []
      break
    case 'health-beauty':
      types = allUrls('health', 0, 1)
      brands = []
      branch = []
      break
    case 'home-services-maintenance':
      types = allUrls('home-services', 0, 1)
      brands = []
      branch = []
      break
    case 'medical':
      types = allUrls('medicalIn', 0, 1)
      brands = []
      branch = []
      break
    case 'movers':
      types = allUrls('moversIn', 0, 1)
      brands = []
      branch = []
      break
    case 'pets':
      types = allUrls('petsIn', 0, 1)
      brands = []
      branch = []
      break
    case 'education':
      branch = []
      brands = []
      types = allUrls('educationIn', 0, 1)
      break
  }
}

function allBranches (branch) {
  switch (replaceChar(branch)) {
    case 'desktop-computers':
    case 'laptop-computers':
      types = []
      break
    case 'video-game-consoles':
      types = allUrls('video-game', 0, 1)
      break
    case 'video-games-accessories':
      types = allUrls('video-games', 0, 1)
      break
    case 'computer-accessories-spare-parts':
      types = allUrls('computer-acc', 0, 1)
      break
  }
}

function replaceChar (ele) {
  if (ele) {
    return ele
      .trim()
      .replace(/(all in |»|❭|\n +)/gi, '')
      .replace(/ *( |\(|\)|\/|,|&|%20|%2C|%26|'s +|’s +) */gi, '-')
      .replace(/(--|---|----)/gi, '-')
      .replace(/--/gi, '-')
      .toLowerCase()
  }
}
function log (s) {
  console.log(s)
}

function allUrls (search, lang, node) {
  let url = []
  if (node) {
    for (const i in urls[search]) {
      url.push(i)
    }
  } else {
    if (lang) {
      for (const i in urls) {
        if (typeof urls[i] === 'object') {
          for (const e in urls[i]) {
            if (replaceChar(e) === replaceChar(search)) {
              url = urls[i][e]
            }
          }
        } else {
          if (replaceChar(i) === replaceChar(search)) {
            url = urls[i]
          }
        }
      }
    } else {
      for (const i in urls) {
        if (typeof urls[i] === 'object') {
          for (const e in urls[i]) {
            url.push(e)
          }
        } else {
          url.push(i)
        }
      }
      url = url.flat().find((r) => replaceChar(r) === replaceChar(search))
    }
  }

  return url || search
}

function trans (ifTrue, ifFalse = ifTrue) {
  return ar ? allUrls(ifTrue, 1) : allUrls(ifFalse)
}

const locSearch = location.search
const pathname = location.pathname
const currentUrl = location.href

// function capitalize(el) {
//   const r = el.split(' ');
//   const s = [];
//   for (const a of r) {
//     s.push(a[0].toUpperCase() + a.slice(1));
//   }
//   return s.join(' ');
// }

const checkLog = $('.hamburger-menu .btn')

function I (ele, value) {
  return (ele.innerHTML = value)
}
function T (ele, value) {
  return (ele.textContent = value)
}
function TX (ele) {
  return ele.textContent.trim()
}

const loader = $('#loader')

if (!$('.loader-span')) {
  I(loader, '<div class="loader-span"></div>')
}

window.onload = () => {
  loader.remove()
}

const search = $('.search-header')
const selectCategory = $('.selectCategory')
const results = $('.search-result')

const categoryIn = $$(
  '#nav:not(#sell #nav) .parent-click div a:not(:first-of-type), .nav-links div div > a:not(:first-of-type)'
)

const parentClick = $$('.parent-click:not(:first-of-type), .nav-links > div')
const clickShow = $$(
  '.click-show:not(.parent .click-show), .nav-links div div'
)

const submit = $$('.sign-in-form input[type="submit"]')

const url = new URLSearchParams(locSearch)

const g = $('.my-chat span')
const footer = $('footer')

function checkLength (input, from, to) {
  const inputText = $(`#${input}`)
  const errorRes = $(`#${input} ~ .inv`)

  inputText.onchange = () => {
    if (inputText.value.length < from) {
      T(
        errorRes,
        ar
          ? `يجب أن يحتوي على أحرف ${from} على الأقل`
          : `Must contain at least ${from} characters`
      )
    } else if (inputText.value.length >= to) {
      T(
        errorRes,
        ar
          ? `يجب ألا يحتوي على أكثر من ${to} حرفًا`
          : `It must not contain more than ${to} characters`
      )
    } else {
      T(errorRes, '')
    }
  }
}

function valNewPass (newpa, retpa) {
  const newPass = $(`#${newpa}`)
  const retPass = $(`#${retpa}`)
  const g = $(`#${retpa} ~ .inv`)
  for (let i = 0; i < submit.length; i++) {
    if (newPass.value !== retPass.value) {
      T(
        g,
        ar ? 'كلمتا المرور غير متطابقتان' : 'The two passwords do not match'
      )
      submit[i].setAttribute('type', 'button')
      checkLength(newpa, 6)
    } else {
      submit[i].setAttribute('type', 'submit')
      T(g, '')
      checkLength(newpa, 6)
    }
  }

  retPass.oninput = () => {
    valNewPass(newpa, retpa)
    newPass.oninput = () => {
      valNewPass(newpa, retpa)
    }
  }
}

if (g || footer) {
  for (let i = 0; i < parentClick.length; i++) {
    parentClick[i].onclick = () => {
      clickShow[i].classList.add('block')
      parentClick[i].onmouseleave = () => {
        clickShow[i].classList.remove('block')
      }
    }
  }
}

if (!checkLog) {
  add('.sign-in-header', 'none')
}

if (g) {
  const lang = $('#lang')
  const urlLoc = new URLSearchParams(locSearch)
  urlLoc.set('lang', replaceChar(TX(lang)))

  lang.href = urlLoc.toString().includes('?') ? urlLoc : '?' + urlLoc

  const hrefS = $$(
    '.header > a, .hamburger-menu a:not(#lang, [onclick], [href="/design/help"])'
  )
  if (checkLog) {
    for (const i of hrefS) {
      i.href = '#'
      i.onclick = () => {
        toggle('.log', 'flex')
      }
    }
  }

  if (!parseInt(TX(g))) {
    g.remove()
  }

  const liTag = (value) => {
    url.set('search', value)
    return `<a href="/design/ads/?${url}">${value}</a>`
  }

  function searches (keyWord = 'all') {
    if (keyWord === 'all' || !keyWord) {
      results.classList.add('trend-result')
    } else {
      results.classList.remove('trend-result')
    }

    let list = []

    fetch(
      'http://localhost/design/components/head.php?query=' + (keyWord || 'all')
    )
      .then((rs) => rs.json())
      .then((result) => {
        list = result.map((data) => (data = liTag(data)))
        I(results, list.join('') || liTag(search.value))
      })
  }

  // searches()

  search.onfocus = () => {
    results.classList.add('block')
  }

  abort(
    "!e.target.classList.contains('search-result') && !e.target.classList.contains('search-header')",
    "remove('.search-result', 'block');add('.search-result', 'none')"
  )

  let a = 0
  search.onkeyup = (r) => {
    const t = r.target.value
    const f = r.key === 'ArrowDown'
    const c = r.key === 'ArrowUp'
    const e = r.key === 'Enter'

    if (f || c || e) {
      if (f) {
        a++
      } else if (c) {
        a--
      }
      const g = $$('.search-result a').length
      a = a <= 1 ? g : a
      a = a >= g ? 1 : a

      remove('.search-result a', 'active')
      const s = $(`.search-result a:nth-child(${a})`)
      s.classList.add('active')
      search.value = f || c ? s.textContent : search.value

      if (e) {
        url.set('search', t)
        location.href = `/design/ads/?${url}`
      }
    } else {
      searches(t)
    }
  }

  selectCategory.oninput = () => {
    const t = selectCategory.value
    url.delete('type[]')
    url.delete('branch')
    url.delete('subcategory')
    url.delete('brand[]')
    if (t === 'all') {
      url.delete('category')
    } else {
      url.set('category', t)
    }
    st(t)
  }

  function st (r = selectCategory.value) {
    selectCategory.style.width = `${r.length * 14}px`
  }

  if (url.has('category')) {
    const rs = selectCategory.querySelector(
      `[value='${url.get('category')}']`
    )

    for (let i = 0; i < selectCategory.querySelectorAll('option').length; i++) {
      if (url.has('category') && rs) {
        selectCategory.style.width = `${TX(rs).length * 14}px`
        rs.selected = true
        st()
      }
    }
  }

  $('#search').onclick = () => {
    if (!search.value) {
      url.delete('search')
    } else {
      url.set('search', search.value)
    }
    location.href = `/design/ads/?${url}`
  }

  if (url.has('location') || url.has('area')) {
    for (const i of $$('#nav a[href]')) {
      i.href += url.has('area')
        ? `&area=${url.get('area')}`
        : `&location=${url.get('location')}`
    }
  }

  if (screen.availWidth < 1152) {
    const navLinks = $$('nav > div > a, .nav-links > div > a')
    for (let i = 0; i < navLinks.length; i++) {
      navLinks[i].setAttribute('href', '#')
    }
  }

  if (screen.availWidth < 768) {
    let prevScroll = window.scrollY
    window.onscroll = () => {
      const currentScroll = window.scrollY
      if (prevScroll > currentScroll) {
        $('header').style.top = '0'
      } else {
        $('header').style.top = '-48px'
      }
      prevScroll = currentScroll
    }
  }

  if (screen.availWidth > 768) {
    let prevScroll = window.scrollY

    window.onscroll = () => {
      const currentScroll = window.scrollY

      if (prevScroll < currentScroll) {
        $('#nav').style.top = '0'
      } else {
        $('#nav').style.top = '65px'
      }
      prevScroll = currentScroll
    }
  }

  const t = $('#welName')
  T(t, TX(t) ? `, ${TX(t).split(' ')[0]}` : '')
}

function isMobile () {
  const toMatch = [
    /Android/i,
    /webOS/i,
    /iPhone/i,
    /iPad/i,
    /iPod/i,
    /BlackBerry/i,
    /Windows Phone/i,
    /mobile/i
  ]
  return toMatch.some((toMatchItem) => navigator.userAgent.match(toMatchItem))
}

function duplicate (array) {
  return array.filter((key, index) => array.indexOf(key) === index)
}

const cardFavorite = $$('.card-fav')
const cardFavoriteFill = $$('.card-fav-fill')

cardFavorite.forEach((element) => {
  element.onclick = (ele) => {
    if ($('.sign-in')) {
      $('.sign-in-form').classList.toggle('flex')
    }
    ele.target.classList.toggle('card-fav-fill')
  }
})
cardFavoriteFill.forEach((element) => {
  element.onclick = (ele) => {
    ele.target.classList.toggle('card-fav-fill')
    ele.target.classList.toggle('card-fav')
  }
})

const scrollingElement = doc.scrollingElement || doc.body

const toBottom = (ele = scrollingElement) => {
  ele.scrollTop = ele.scrollHeight
}

// eslint-disable-next-line no-unused-vars
const backTop = (ele = scrollingElement) => {
  ele.scrollTop = 0
}

function radInput (type, array, ele, lang, name = ele) {
  const el = $$(`.${ele} label:not(.checked)`)
  for (let i = 0; i < el.length; i++) {
    I(
      el[i],
      `<input type='${type}' name='${name + array}' value='${
        lang ? el[i].id : replaceChar(TX(el[i]))
      }'>${TX(el[i])}`
    )
  }
}

const removeMessage = $$("[class*='alert'],[id*='alert'], .thanks")
for (let i = 0; i < removeMessage.length; i++) {
  removeMessage[i].onclick = () => {
    removeMessage[i].style.display = 'none'
  }
}

const alertLocation = $('#alert-location')

function getLocation (fun) {
  if (!navigator.geolocation.getCurrentPosition) {
    I(
      alertLocation,
      ar
        ? 'متصفحك لا يدعم تحديد الموقع!'
        : "Your browser doesn't support location identification!"
    )
  } else {
    navigator.geolocation.getCurrentPosition(fun, errHand)
  }
}

function errHand (err) {
  alertLocation.style.display = 'flex'
  switch (err.code) {
    case err.PERMISSION_DENIED:
      T(
        alertLocation,
        ar
          ? 'التطبيق ليس لديه إذن تحديد الموقع.'
          : 'The app does not have location permission.'
      )
      break
    case err.POSITION_UNAVAILABLE:
      T(
        alertLocation,
        ar ? 'موقع الجهاز غير مؤكد.' : 'Device location is uncertain.'
      )
      break
    case err.TIMEOUT:
      T(
        alertLocation,
        ar
          ? 'انتهت المهلة للحصول على موقع المستخدم.'
          : "Timed out to get the user's location."
      )
      break
    case err.UNKNOWN_ERROR:
      T(
        alertLocation,
        ar ? 'حدث خطأ ما حاول مرة أخرى.' : 'Something went wrong!, Try again.'
      )
      break
  }
}

const locationUrl = new URLSearchParams(locSearch)

let locations = $$('.filter-location-in > div > a, .header-map a')

locationUrl.delete('page')
locationUrl.delete('ad')
locationUrl.delete('area')

for (let i = 0; i < locations.length; i++) {
  locationUrl.set('location', locations[i].id)
  locations[i].setAttribute('href', `/design/ads/?${locationUrl}`)
}

// / ///////////// START home.js

const cards = $$('.cards-row, .listen-cards')
for (const i of cards) {
  if (TX(i).length <= 20) {
    if (!i.classList.contains('listen-cards')) {
      i.parentElement.remove()
    }
  } else {
    const t = JSON.parse(TX(i))
    let s = ''
    for (const e of t) {
      s += `<article class='listen-card'><a><img alt="" src='${e.photos}'><div class='card-info'><span class='price'>${e.price}</span><h4 class='listen-title'>${e.title}</h4><div><div class='listen-location'>${trans(e.area)}, ${trans(e.location)}.</div><div class='date'>${e.created}</div></div></div></div></a><input ${e.class} value='${e.id}'></article>`
    }
    I(i, s)
  }
}

function price (num) {
  if (num.indexOf('allowance') >= 0) {
    return trans('for allowance')
  }
  return new Intl.NumberFormat(ar ? 'ar' : undefined, {
    maximumSignificantDigits: 21,
    style: 'currency',
    currency: 'egp'
  }).format(num)
}

function home () {
  const listen = $$('.listen-title')
  const listenImg = $$('.listen-card a')
  for (let i = 0; i < listen.length; i++) {
    if (listenImg[i]) {
      listenImg[i].setAttribute(
        'href',
        `/design/ad/?ad=${encodeURIComponent(TX(listen[i]))}`
      )
    }
    T(listen[i], TX(listen[i]).replace(/-[0-9]{0,}$/, ''))
  }

  date($$('.date'))

  const listenImgDir = $$('.listen-card a > img, .ad-img')

  for (let i = 0; i < listenImgDir.length; i++) {
    const gt = listenImgDir[i].getAttribute('src')
    const tg = gt.split(' -^- ')
    listenImgDir[i].setAttribute(
      'src',
      `/design/uploads/${tg[parseInt(tg[0]) + 1]}`
    )
  }

  for (const i of $$('.price:not(#sell .price)')) {
    T(i, price(TX(i)))
  }
  // console.clear();
}

const formatter = new Intl.RelativeTimeFormat(ar ? 'ar' : undefined, {
  numeric: 'auto'
})

const DIVISIONS = [
  { amount: 60, name: 'seconds' },
  { amount: 60, name: 'minutes' },
  { amount: 24, name: 'hours' },
  { amount: 7, name: 'days' },
  { amount: 4.34524, name: 'weeks' },
  { amount: 12, name: 'months' },
  { amount: Number.POSITIVE_INFINITY, name: 'years' }
]

function formatTimeAgo (date) {
  let duration = (new Date(date) - new Date()) / 1000

  for (let i = 0; i < DIVISIONS.length; i++) {
    const division = DIVISIONS[i]
    if (Math.abs(duration) < division.amount) {
      return formatter.format(Math.round(duration), division.name)
    }
    duration /= division.amount
  }
}

function date (listenDate) {
  for (let i = 0; i < listenDate.length; i++) {
    T(listenDate[i], formatTimeAgo(TX(listenDate[i])) + '.')
  }
}

// //////////////// END home.js

// //////////////// START save.js

if (currentUrl.includes('/myads/')) {
  const r = $('#dash-cards')
  const st = $('#new-chats')
  let chatsRes = 0

  if (TX(r).length > 10) {
    const t = JSON.parse(TX(r))
    let s = ''
    for (const e of t) {
      s += `
 <article class='listen-card'><a><img alt="" src='${e.photos}'>
 <div class='card-info'>

 <div>
 
 <span class='price'>${e.price}</span>
 <div class='delete' id='${e.id}'>
</div>

</div>
 
 <h4 class='listen-title'>${e.title}</h4>

 <ul class='my-card-info'>

<li title='${
        ar ? 'محادثات' : 'chats'
      }'><img src='../icons/chat-square-dots.svg' alt='${
        ar ? 'محادثات' : 'chats'
      }'>${e.chats}</li>
<li title='${
        ar ? 'إظهار الرقم' : 'Show Number'
      }'><img src='../icons/telephone.svg' alt='${
        ar ? 'إظهار الرقم' : 'Show Number'
      }'>${e.display_number}</li>
<li title='${ar ? 'المشاهدات' : 'Views'}'><img src='../icons/eye.svg' alt='${
        ar ? 'المشاهدات' : 'Views'
      }'>${e.views}</li>
<li title='${
        ar ? 'المفضلة' : 'Favorites'
      }'><img src='../icons/heart.svg' alt='${ar ? 'المفضلة' : 'Favorites'}'>${
        e.favorites
      }</li></ul><div class='date'>${e.created}</div>
 
</div>
</div>
</a>
<input></article> 
 
 `
    }
    I(r, s)

    const deleteIn = $$('.delete')
    const deleteAd = $('#delete-ad')

    const chats = $$('.my-card-info li:nth-child(1)')
    const showNumber = $$('.my-card-info li:nth-child(2)')
    const views = $$('.my-card-info li:nth-child(3)')
    const favorites = $$('.my-card-info li:nth-child(4)')

    const cardInput = $$('.listen-card> input')

    let favoritesRes = 0
    let showNumberRes = 0
    let viewsRes = 0

    for (let i = 0; i < deleteIn.length; i++) {
      I(
        deleteIn[i],
        `<span title='${
          ar ? 'حذف' : 'delete'
        }'><img src='../icons/trash.svg' alt='${ar ? 'حذف' : 'delete'}'></span>`
      )

      $$('.card-info .delete')[i].onclick = (r) => {
        r.preventDefault()
        toggle('.delete-ad', 'block')
        deleteAd.value = deleteIn[i].id
      }

      cardInput[i].type = 'submit'
      cardInput[i].title = ar ? 'تعديل' : 'edit'
      cardInput[i].alt = ar ? 'تعديل' : 'edit'
      cardInput[i].name = 'id'
      cardInput[i].value = deleteIn[i].id

      viewsRes += parseInt(TX(views[i]))
      favoritesRes += parseInt(TX(favorites[i]))
      showNumberRes += parseInt(TX(showNumber[i]))
      chatsRes += parseInt(TX(chats[i]))
    }

    T($('#views'), viewsRes)
    T($('#show-number'), showNumberRes)
    T($('#favorites'), favoritesRes)

    const sorts = $$('.sort-by a')

    for (let i = 0; i < sorts.length; i++) {
      sorts[i].setAttribute(
        'href',
        `/design/myads/?sort=${sorts[i].className}`
      )
    }
  } else {
    T(r, '')
    $('.no-result').style.display = 'flex'
  }

  if (parseInt(TX(g))) {
    T(st, TX(g))
  } else {
    const gi = $('.dash-over-view a')
    gi.href = '#'
    I(
      gi,
      `<img alt="" src="../icons/chat-square-dots.svg">${
        ar ? 'الدردشات' : 'chats'
      }<span id="new-chats">${chatsRes}</span>`
    )
  }
}

if (currentUrl.includes('/myfavorites/')) {
  const i = $('.saved-searches')

  let s = ''
  if (TX(i).length > 10) {
    const t = JSON.parse(TX(i))
    for (const e of t) {
      s += `<article class='listen-card'><a><img alt="" src='${e.photos}'><div class='card-info'><span class='price'>${e.price}</span><h4 class='listen-title'>${e.title}</h4><div><div class='listen-location'>${trans(e.area)}, ${trans(e.location)}.</div><div class='date'>${e.created}</div></div></div></div></a><input class='card-fav-fill' type='submit' name='remove' value='${e.id}'></article>`
    }
  } else {
    $('.no-result').style.display = 'flex'
  }

  I(i, s)
}

const notSub = $$(
  '.listen-card form, #delete-ad, .delete, button[name="logOut"], .sign-in-form'
)

for (let i = 0; i < notSub.length; i++) {
  notSub[i].onsubmit = () => {}
}

// //////////////// END save.js

// //////////////// START chat.js

if (currentUrl.includes('/chat/') && !checkLog) {
  const adId = url.get('ad-id')
  const adChat = $('#listen-chat')
  const listenView = $('.listen-chat-view')

  fetch(`http://localhost/design/chat/chat.php/?ad-id=${adId}`)
    .then((value) => value.json())
    .then((res) => {
      const t = res.values

      $('#userId').href = `/design/user/?user-id=${t.userId}`
      $('#tel').href = `tel:${t.phone}`
      T($('#name'), t.name)
      $('.listen-chat-header').href = `/design/ad/?ad=${t.title}`
      T($('.listen-title'), t.title)

      $('.img').src = t.photos
      $('.img').classList.add('ad-img')

      T($('.price'), t.price)
      $("input[name='sales']").value = t.buyer

      const r = res.right
      const c = res.chat
      let s = ''
      for (const i of r) {
        s += `<a href='/design/chat/?ad-id=${i.ad}' ${i.class}>
   <p><img alt="" class='ad-img' src='${i.img}'>${i.title}</p>
   ${i.unread}
   <p>${i.message}</p>
   <span class='date'>${i.date}</span>
</a>`
      }

      $('.chat-in').innerHTML += s

      const chatS = $$('.chat-in a')
      const chat = $('.chat-in a')

      if (!chat) {
        add('.no-result:last-of-type', 'flex')
      }

      if (!adId) {
        $('.chat-top span').onclick = () => {
          history.back()
        }
        add('.chat', 'block')

        add('.no-result:first-of-type', 'flex')
        add('.not, .listen-chat-bottom', 'v-none')
      }

      let g = ''
      for (const i of c) {
        if (i.user === t.userId) {
          g += `<div class='listen-message-from'><div class='messageIn'>${i.message}</div><span class='${i.seen} date'>${i.created}</span></div>`
        } else {
          g += `<div class='listen-message-to'><div class='messageIn'>${i.message}</div><span class='${i.seen} date'>${i.created}</span></div>`
        }
      }

      adChat.innerHTML += g

      const emojis = $$('.emojis div span')
      const textArea = $('#message')

      for (let i = 0; i < emojis.length; i++) {
        emojis[i].onclick = () => {
          textArea.value += emojis[i].outerText
        }
      }

      // / ////////////////////////////////////

      textArea.oninput = () => {
        this.style.height = '39px'
        this.style.height = `${this.scrollHeight}px`
      }

      // / ///////////////////////////////////////////////

      function activeImgMsg () {
        const adImg = $$('#listen-chat img')
        for (let i = 0; i < adImg.length; i++) {
          adImg[i].onclick = (r) => {
            r.target.classList.toggle('active')
          }
        }
      }

      activeImgMsg()

      function showLoc (pos) {
        const st = `https://www.google.com/maps/place/${pos.coords.latitude},${pos.coords.longitude}`
        adChat.innerHTML += `<div class="listen-message-to"><div class="messageIn listen-message-gallery"><a href="${st}" target="_blank"><img src="../icons/location-ico.svg" alt="${
          ar ? 'رابط الموقع' : 'Location link'
        }"></a></div>`
        const formData = new FormData()
        formData.append('message', st)
        uploadMultiple(formData)
        messageDetails()
      }

      $('#send-location').onclick = () => {
        getLocation(showLoc)
      }

      function messageDetails () {
        const messages = $$('#listen-chat .listen-message-to:last-child')

        for (let i = messages.length - 1; i < messages.length; i++) {
          messages[
            i
          ].innerHTML += `<span class="message-check now date">${new Date().toISOString()}</span>`
        }
        date($$('.date.now'))
      }

      // / //////////////////////////////

      function uploadMultiple (data) {
        fetch(`http://localhost/design/chat/chat.php/?ad-id=${adId}`, {
          method: 'POST',
          body: data
        })
        toBottom(listenView)
      }

      const submitChat = $('#submit-listen-chat')

      function submitMessage (value) {
        const t = doc.createElement('p')
        t.classList.add('listen-message-to')
        I(t, `${value}`)
        adChat.appendChild(t)

        messageDetails()
        textArea.style.height = '35px'
      }

      submitChat.onclick = () => {
        const formData = new FormData()
        const r = textArea.value
        if (r) {
          submitMessage(r)
          formData.append('message', r)
          uploadMultiple(formData)
          textArea.value = ''
          toBottom(listenView)
        }
      }

      const imageInput = $('#send-image')
      const videoInput = $('#send-video')
      const audioInput = $('#send-audio')
      const voiceInput = $('#send-voice')
      const documentInput = $('#send-document')

      function messageGallery (el, type, end) {
        el.onchange = (event) => {
          textArea.value = ''
          const messageGallery = doc.createElement('div')
          messageGallery.classList.add(
            'listen-message-to',
            'listen-message-gallery'
          )

          let s = ''
          for (let i = 0; i < el.files.length; i++) {
            if (event.target.files.length > 0) {
              s += `<div><${type} src="${URL.createObjectURL(
                event.target.files[i]
              )}">${end}<span>${event.target.files[i].name} (${
                Math.round((event.target.files[i].size / 1000000) * 100) / 100
              }MB)</span></div>`
            }
          }

          I(messageGallery, `${s}`)
          adChat.appendChild(messageGallery)
          messageDetails()
          activeImgMsg()

          toBottom(listenView)

          const formData = new FormData(listenView)

          uploadMultiple(formData)
        }
      }

      messageGallery(imageInput, 'img', '')
      messageGallery(videoInput, 'video controls', '</video>')
      messageGallery(audioInput, 'audio controls', '</audio>')
      messageGallery(voiceInput, 'audio controls', '</audio>')

      documentInput.onchange = (event) => {
        const messageGallery = doc.createElement('div')
        messageGallery.classList.add(
          'listen-message-to',
          'listen-message-gallery'
        )

        let s = ''
        for (let i = 0; i < documentInput.files.length; i++) {
          if (event.target.files.length > 0) {
            s += `<a href='${URL.createObjectURL(
              event.target.files[i]
            )}'><img alt="" src='../icons/file-earmark.svg'><span>${
              event.target.files[i].name
            } (${
              Math.round((event.target.files[i].size / 1000000) * 100) / 100
            }MB)</span></a>`
          }
        }

        I(messageGallery, `${s}`)

        adChat.appendChild(messageGallery)
        messageDetails()
        activeImgMsg()
      }

      const allMessages = $$('.messageIn')

      for (let i = 0; i < allMessages.length; i++) {
        if (
          TX(allMessages[i]).search(/( -\^- |\.\w+\w+\w*\w*\w*\w*)+/gi) !== -1
        ) {
          let messagesPaths = ''

          const messages = TX(allMessages[i]).split(' -^- ')

          allMessages[i].classList.add('listen-message-gallery')

          for (let e = 0; e < messages.length; e++) {
            const fileSrc = messages[e].slice(
              0,
              messages[e].search(/-\^-\(\w+\)+$/)
            )

            let fileSize = messages[e].search(/-\^-\(\w+\)+$/)
            fileSize = messages[e].slice(fileSize + 4)
            fileSize = `(${
              Math.round((fileSize.replace(/\)/, '') / 1000000) * 100) / 100
            }MB)`

            const fileName =
              messages[e].replaceAll(/-\^-\(\w+\)+$/g, '') + fileSize

            if (
              messages[e].search(
                /(\.jpeg|\.jpg|\.png|\.tiff|\.bmp|\.gif|\.svg|\.bmp|\.svg|\.eps|\.ai)+/gi
              ) !== -1
            ) {
              messagesPaths += `<div><img src='../uploads/${fileSrc}' alt='${fileName}'><p>${fileName}</p></div>`
            } else if (
              messages[e].search(
                /(\.mp4|\.avi|\.mpg|\.3gp|\.m4v|\.mgv|\.mov|\.mkv|\.ogv|\.qtm|\.amc|\.dvx|\.flv|\.evo|\.mpeg|\.mpg|\.wimp|\.m4v|\.swf|\.mod|\.dvr|\.dat|\.h264|\.avi|\.asx|\.asf|\.wmv|\.m2t|\.vob|\.rec|\.mts|\.rmvb|\.tp)+/gi
              ) !== -1
            ) {
              messagesPaths += `<div><video controls src='../uploads/${fileSrc}' alt=' ${fileName}'></video><p>${fileName}</p></div>`
            } else if (
              messages[e].search(
                /(\.M4A|\.FLAC|\.MP3|\.WAV|\.WMA|\.AAC|\.ogg|\.m3u|\.acc|\.wma|\.midi|\.aif|\.m4a|\.mpa|\.pls)+/gi
              ) !== -1
            ) {
              messagesPaths += `<div><audio controls src='../uploads/${fileSrc}' alt=' ${fileName}'></audio><p>${fileName}</p></div>`
            } else if (
              messages[e].search(/Https:\/\/Www\.Google\.Com\/Maps/gi) !== -1
            ) {
              messagesPaths += `<a href='${
                messages[e]
              }' target='_blank'><img src='../icons/location-ico.svg' alt='${
                ar ? 'رابط' : 'Link'
              }'></a>`
            } else if (messages[e].search(/(Https:\/\/|Http:\/\/)+/gi) !== -1) {
              messagesPaths += `<a href='${
                messages[e]
              }' target='_blank'><img src='../icons/paper-clip.svg' alt='${
                ar ? 'رابط الموقع' : 'Location Link'
              }'><p>${messages[e]}</p></a>`
            } else {
              messagesPaths += `<a href='../uploads/${fileSrc}' target='_blank'><img src='../icons/file-earmark.svg' alt=' ${fileName}'><p>${fileName}</p></a>`
            }
          }

          I(allMessages[i], messagesPaths)
        }
      }

      const a = $('#unreadMes')
      const q = $('#allR')

      a.onclick = () => {
        q.classList.remove('active')
        a.classList.add('active')
        add('.chat-in > a', 'v-none')

        for (const a of $$('.chat-in > a')) {
          if (a.querySelector('span:nth-child(2)')) {
            a.classList.remove('v-none')
            a.classList.add('flex')
          }
        }
      }

      q.onclick = () => {
        q.classList.add('active')
        a.classList.remove('active')
        remove('.chat-in > a', 'v-none')
        add('.chat-in > a', 'flex')
      }

      const allS = $('#allS')
      const buys = $('#buys')
      const sales = $('#sales')

      const sale = $("input[name='sales']").value.split(' ,')

      const rUrl = '/design/chat/?ad-id='

      function checkChats (element, method, t, g) {
        element.onclick = (r) => {
          remove('.chat-type span', 'active')
          r.target.classList.add('active')

          t('.chat-in a', 'v-none')

          for (let i = 0; i < sale.length - 1; i++) {
            for (let e = 0; e < chatS.length; e++) {
              if (
                eval(
                  chatS[e].href.replace(`http://localhost${rUrl}`, '') +
                    method +
                    sale[i]
                )
              ) {
                g(`.chat-in a[href='${rUrl + sale[i]}']`, 'v-none')
              }
            }
          }
        }
      }

      checkChats(buys, '===', add, remove)
      checkChats(sales, '!==', remove, add)

      allS.onclick = (r) => {
        remove('.chat-type span', 'active')
        r.target.classList.add('active')

        remove('.chat-in > a', 'v-none')
      }

      for (const a of $$(
        '.chat-in > a p:nth-child(3), .chat-in > a p:nth-child(2)'
      )) {
        T(a, TX(a).replace(/(-\^-\(\d+\)|-\^-|-\d+$)/gi, ''))
      }

      $('#delete').onclick = () => {
        const formData = new FormData()
        formData.append('delete', 'on')
        uploadMultiple(formData)
      }

      const ac = $('.chat-ico-act')
      if (!parseInt(TX(ac))) {
        ac.remove()
      }

      toBottom(listenView)
      home()
      activeImgMsg()
    })
}

// //////////////// END chat.js

// //////////////// START mysearches.js

if (currentUrl.includes('/mysearches/')) {
  const savedSearches = $('.saved-searches')
  const savedRes = TX(savedSearches).split(' -^-')

  let priceSearch
  let categorySearch
  let locationSearch

  let savedResults = ''
  if (savedRes.length - 1) {
    for (let i = 0; i < savedRes.length - 1; i++) {
      const savedUrl = new URLSearchParams(savedRes[i].trim())

      const subcategorySe = trans(savedUrl.get('subcategory'))
      const typeS = trans(savedUrl.get('type[]'))
      const brandS = trans(savedUrl.get('brand[]'))
      const categoryS = trans(savedUrl.get('category'))
      const areaS = trans(savedUrl.get('area'))
      const locS = trans(savedUrl.get('location'))
      const fromS = savedUrl.get('from-price')
      const toS = savedUrl.get('to-price')
      const stS = trans(savedUrl.get('status[]'))
      const soS = trans(savedUrl.get('sort'))

      if (typeS) {
        categorySearch = typeS
      } else if (subcategorySe) {
        categorySearch = subcategorySe
      } else if (categoryS) {
        categorySearch = categoryS
      }

      if (areaS) {
        locationSearch = areaS
      } else if (locS) {
        locationSearch = locS
      }

      if (fromS && toS) {
        priceSearch = `${price(fromS) + ' ' + trans('to') + ' ' + price(toS)}`
      } else if (fromS) {
        priceSearch = trans('from') + ' ' + price(fromS)
      } else if (toS) {
        priceSearch = trans('to') + ' ' + price(toS)
      }

      savedResults += `<article class="saved-search"><a href='/design/ads/?${savedUrl}'>
 <div class="saved-search-top">
 <span>${trans(categorySearch)} ${
        locationSearch ? ` ${trans('in')} ${trans(locationSearch)}` : ''
      }</span>
</div>
 ${
   locationSearch
     ? `<div><span>${trans('location')}:</span><span>${trans(
         locationSearch
       )}</span></div>`
     : ''
 }
 ${
   categorySearch
     ? `<div><span>${trans('category')}:</span><span>${trans(
         categorySearch
       )}</span></div>`
     : ''
 }
 
 ${
   savedUrl.get('price')
     ? `<div><span>${trans('for allowance')}:</span><span>${trans(
         'yes'
       )}</span></div>`
     : ''
 }
 ${
   savedUrl.get('installment')
     ? `<div><span>${trans('in installments')}:</span><span>${trans(
         'yes'
       )}</span></div>`
     : ''
 }
 
 ${
   priceSearch
     ? `<div><span>${trans('price')}:</span><span>${priceSearch}</span></div>`
     : ''
 }
 ${
   stS
     ? `<div><span>${trans('status')}:</span><span>${trans(stS)}</span></div>`
     : ''
 }
 ${soS ? `<div><span>${trans('sort by')}:</span><span>${soS}</span></div>` : ''}
 ${
   brandS
     ? `<div><span>${trans('brand')}:</span><span>${brandS}</span></div>`
     : ''
 }
</a>
 
 <input type='submit' class="card-fav-fill" name='remove-search' value='${encodeURIComponent(
   savedRes[i]
 )}'></input>
</article>`
    }
  } else {
    $('.no-result').classList.add('flex')
  }
  I(savedSearches, savedResults)
}

// //////////////// END mysearches.js

// //////////////// START ads.js

const adId = $('.sell-form > input')

function dataList () {
  const dataHead = $$('.datalist-head')
  const data = $$('.datalist')
  const dataGro = $$('.datalist div')
  const dataIn = $$('.datalist label')

  for (let t = 0; t < dataGro.length; t++) {
    dataGro[t].classList.add('v-none')
  }

  for (let i = 0; i < dataHead.length; i++) {
    const st = data[i].querySelector('label:first-of-type')

    if (adId.value && TX(dataHead[i])) {
      const t = TX(dataHead[i])
      const headD = data[i].querySelector(`input[value='${t}']`)
      if (headD) {
        headD.checked = true
        T(dataHead[i], headD.value.replaceAll(/-/g, ' '))

        let headTi = ''
        for (const i of dataIn) {
          if (TX(i) === trans(TX($('.locationH'))) || TX(i) === TX($('.locationH'))) {
            headTi = i.id
          }
        }

        const ast = headTi.toLowerCase().split('-')

        for (let t = 0; t < dataGro.length; t++) {
          dataGro[t].classList.add('v-none')
          if (ast[0]) {
            $(`.${ast[1] || ast[0]}`).classList.remove('v-none')
          }
        }

        const r = $(`.${t}`)
        if (r) {
          r.classList.remove('v-none')
        }
        const s = trans(t)
        if (s.length) {
          T(dataHead[i], s)
        }
      }
    } else if (st) {
      T(dataHead[i], TX(st))
      const t = data[i].querySelector('input:first-of-type')
      if (t) {
        t.checked = true
      }
    }

    dataHead[i].onclick = (r) => {
      data[i].classList.toggle('flex')

      for (let f = 0; f < dataIn.length; f++) {
        dataIn[f].onclick = (u) => {
          if (TX(u.target)) {
            data[i].classList.remove('flex')
            T(r.target, TX(u.target))

            for (let t = 0; t < dataGro.length; t++) {
              dataGro[t].classList.add('v-none')
            }

            const t = u.target.parentElement.classList

            if (t.contains('location')) {
              const c = $(`.${u.target.id}`)
              c.classList.remove('v-none')
              const g = c.querySelector('input')
              g.checked = true
              T($('.areaHead'), trans(g.value))
            }

            t.remove('v-none')
          }
        }
      }
    }
  }
}

const state = $('.status')
const ship = $('.ship')

function allCategories (category) {
  switch (replaceChar(category)) {
    case 'jobs':
      text('#salary', ar ? 'مرتب:' : 'salary:')
      text('#field', ar ? 'مجال:' : 'field:')
      add('#allowance, .in-job', 'none')
    case 'properties':
      ship.classList.add('none')
    case 'pets-accessories':
      state.classList.add('none')
      break
  }
}

if (currentUrl.includes('/ads/')) {
  const r = $('#searchIn')
  if (r.value) {
    search.value = r.value
  }

  const filterUrl = new URLSearchParams(locSearch)
  const categoryFil = filterUrl.get('category')
  const subCategoryFil = filterUrl.get('subcategory')
  const typeFil = filterUrl.get('type[]')
  const branchFil = filterUrl.get('branch')

  let subCategories = []

  if (categoryFil) {
    const value = $(
      `#nav a[href*="/design/ads/?category=${categoryFil}"]`
    ).parentNode.querySelectorAll('div a')
    for (let e = 2; e < value.length; e++) {
      let href = value[e].href
      const s = href.indexOf('subcategory')
      href = href.slice(s + 12)
      href = href.slice(0, href.indexOf('&') !== -1 ? href.indexOf('&') : '')
      subCategories.push(href)
    }
  }

  subCategories = duplicate(subCategories)

  allCategories(categoryFil)
  allSubCategories(subCategoryFil)
  allBranches(branchFil)

  function showMore (ele) {
    const vr = $(`.${ele}`)
    const st = $(`.${ele} + .textClick`)

    vr.classList.add('show-more')

    if (vr.children.length >= 5) {
      st.onclick = () => {
        if (TX(st) !== trans('show more')) {
          vr.classList.add('show-more')
          T(st, trans('show more'))
        } else {
          vr.classList.toggle('show-more')
          T(st, trans('show less'))
        }
      }
      st.classList.remove('none')
    } else {
      st.classList.add('none')
    }
  }

  function addFil (ele, array, type, checkbox = '') {
    const el = $(ele)
    const clas = el.classList.toString().split(' ')[0]
    if (!array.length) {
      el.parentNode.classList.add('none')
    } else {
      el.parentNode.classList.remove('none')
    }

    let value = ''
    for (const i in array) {
      value += `<li><label><input type='${type}' name='${
        clas + checkbox
      }' value='${replaceChar(array[i])}'>${trans(array[i])}</label></li>`
    }

    I(el, value)
    showMore(clas)
  }

  addFil('.subcategory', subCategories, 'radio')
  addFil('.branch', branch, 'radio')
  addFil('.brand', brands, 'checkbox', '[]')
  addFil('.type', types, 'checkbox', '[]')

  const cards = $('.listen-cards')

  const rs = doc.createElement('article')
  const cardLen = $$('.listen-card').length

  const directory = $('.directory')

  cards.insertBefore(rs, cards.children[Math.round(cardLen / 2)])
  rs.classList.add('add-things')

  I(
    cards.querySelector('.add-things'),
    ar
      ? '<p>هل تريد رؤية الأشياء الخاصة بك هنا؟</p><p>اكسب المال عن طريق بيع الأشياء الخاصة بك،<b> مجانًا!</b></p><a href="/design/sell " class="outline-btn">بيع الآن<ri>»</ri></a>'
      : '<p>do you want to see your things here?</p><p>earn mony by selling your things,<b> for free!</b></p><a href="/design/sell" class="outline-btn">sell now<ri>»</ri></a>'
  )

  if (categoryFil) {
    directory.innerHTML += `<a href='/design/ads/?category=${categoryFil}'>${trans(categoryFil)}</a>`
  }

  let ts

  if (subCategoryFil) {
    let tr = ''

    for (let e = 0; e < categoryIn.length; e++) {
      let href = categoryIn[e].href
      const s = href.indexOf('subcategory')
      href = href.slice(s + 12)
      href = href.slice(0, href.indexOf('&') !== -1 ? href.indexOf('&') : '')

      if (href === subCategoryFil) {
        const ts = categoryIn[e].parentElement.querySelector('a').href
        const rs = ts.indexOf('category') + 9
        tr = `/design/ads/?category=${ts.slice(rs)}`
        break
      }
    }

    ts = `${tr}&subcategory=${subCategoryFil}`

    directory.innerHTML += `<a href='${ts}'>${trans(subCategoryFil)}</a>`
  }

  if (branchFil) {
    directory.innerHTML += `<a href='${ts}&branch=${branchFil}'>${trans(
      branchFil
    )}</a>`
  }

  if (typeFil) {
    directory.innerHTML += `<a href='${ts}${
      branchFil ? `&branch=${branchFil}` : ''
    }&type=${typeFil}'>${trans(typeFil)}</a>`
  }

  if (!cardLen) {
    directory.innerHTML += ar
      ? "<div class='no-result flex'><img alt=\"\" src='/design/icons/ban.svg'>يبدو أنه لا توجد نتيجة متاحة!<br>حاول مرة أخرى باستخدام مرشحات مختلفة.</div>"
      : "<div class='no-result flex'><img alt=\"\" src='/design/icons/ban.svg'>There seems to be no result available!<br>Try again using different filters.</div>"
  }

  locations = $$('.filter-location-in div ul a')

  for (let i = 0; i < locations.length; i++) {
    locationUrl.delete('location')

    locationUrl.set('area', locations[i].id)
    locations[i].setAttribute('href', `/design/ads/?${locationUrl}`)
  }

  const sortUrl = new URLSearchParams(locSearch)

  const sorts = $$('.sort-by a')

  for (let i = 0; i < sorts.length; i++) {
    sortUrl.set('sort', sorts[i].className)
    sorts[i].setAttribute('href', `/design/ads/?${sortUrl}`)
  }

  const subSearch = new URLSearchParams(locSearch)

  function addUrl (param) {
    const parameters = $$(`input[name='${param}[]']`)

    for (let i = 0; i < parameters.length; i++) {
      parameters[i].onclick = () => {
        subSearch.set(param, parameters[i].value)
      }
    }
  }

  addUrl('status')
  addUrl('brand')
  addUrl('subcategory')

  let pageUrl = new URLSearchParams(locSearch)

  const currentPage = parseInt(pageUrl.get('page')) || 1

  pageUrl.delete('page')
  pageUrl = `?${pageUrl}&page=`

  const togglePages = $('.toggle-pages')
  const lastPage = $('.toggle-pages a:last-of-type')
  T($('#ads-results'), `${TX(lastPage)} ${trans('result')}`)
  const pages = Math.floor(TX(lastPage) / 40)

  if (pages <= 1) {
    lastPage.classList.add('none')
  } else if (currentPage >= pages - 4) {
    I(
      togglePages,
      `<a href='${pageUrl + 1}'>1</a><a href='${
        pageUrl + (currentPage - 1)
      }'>❮</a><a href='${pageUrl + (pages - 4)}'>${pages - 4}</a><a href='${
        pageUrl + (pages - 3)
      }'>${pages - 3}</a><a href='${pageUrl + (pages - 2)}'>${
        pages - 2
      }</a><a href='${pageUrl + (pages - 1)}'>${pages - 1}</a><a href='${
        pageUrl + pages
      }'>${pages}</a>${
        currentPage + 1 > pages
          ? ''
          : `<a href=${pageUrl}${currentPage + 1}>❯</a>`
      }`
    )
  } else if (currentPage >= 4) {
    I(
      togglePages,
      `<a href='${pageUrl + 1}'>1</a><a href='${
        pageUrl + (currentPage - 1)
      }'>❮</a><a href='${pageUrl + currentPage}'>${currentPage}</a><a href='${
        pageUrl + (currentPage + 1)
      }'>${currentPage + 1}</a><a href='${pageUrl + (currentPage + 2)}'>${
        currentPage + 2
      }</a><a href='${pageUrl + (currentPage + 3)}'>${
        currentPage + 3
      }</a><a href='${pageUrl + (currentPage + 1)}'>❯</a><a href='${
        pageUrl + pages
      }'>${pages}</a>`
    )
  } else {
    I(
      togglePages,
      `${
        currentPage >= 1 ? '' : `<a href='${pageUrl + (currentPage - 1)}'>❮</a>`
      }<a href='${pageUrl + 1}'>1</a><a href='${pageUrl + 2}'>2</a><a href='${
        pageUrl + 3
      }'>3</a><a href='${pageUrl + 4}'>4</a><a href='${
        pageUrl + (currentPage + 1)
      }'>❯</a><a href='${pageUrl + pages}'>${pages}</a>`
    )
  }

  $(
    `.toggle-pages a${
      currentPage > 1 ? `[href*='&page=${currentPage}']` : ':first-of-type'
    }`
  ).classList.add('active')

  const negativePages = $$(
    ".toggle-pages a[href*='&page=-'],.toggle-pages a[href*='&page=0']"
  )
  if (negativePages) {
    for (let i = 0; i < negativePages.length; i++) {
      negativePages[i].classList.add('none')
    }
  }

  const filters = $$('.filters input')

  for (let i = 0; i < filters.length; i++) {
    if (
      filterUrl.has(filters[i].name.replace(/\[\]/gi, ''), filters[i].value) ||
      filterUrl.has(filters[i].name, filters[i].value)
    ) {
      const parent = filters[i].parentElement.parentElement.parentElement

      const labelVa = parent.querySelector('label')
      const storeIn = filters[i].parentElement.innerHTML

      I(filters[i].parentElement, labelVa.innerHTML)
      I(labelVa, storeIn)

      const inputVa = parent.querySelector('input')
      const store = inputVa.value
      inputVa.value = filters[i].value
      filters[i].value = store

      $(`.filters input[value*='${inputVa.value}']`).checked = true
    }
  }

  function filter () {
    const radioFil = $$(".filters [type='radio']")

    for (let i = 0; i < radioFil.length; i++) {
      radioFil[i].oninput = (r) => {
        const t = r.target.name === 'branch'
        if (r.target.name === 'subcategory' || t) {
          allSubCategories(r.target.value)
          allBranches(r.target.value)

          addFil('.branch', branch, 'radio')
          addFil('.brand', brands, 'checkbox', '[]')
          addFil('.type', types, 'checkbox', '[]')

          filterUrl.delete('brand[]')
          filterUrl.delete('type[]')
          filterUrl.delete('branch')
          filter()
          if (t) {
            $(`.filters input[value='${r.target.value}']`).checked = true
          }
        }
        filterUrl.set(r.target.name, r.target.value)
      }
    }

    const checkboxFil = $$(".filters [type='checkbox']")
    for (let i = 0; i < checkboxFil.length; i++) {
      checkboxFil[i].oninput = (r) => {
        if (r.target.checked) {
          filterUrl.append(checkboxFil[i].name, checkboxFil[i].value)
        } else {
          filterUrl.delete(checkboxFil[i].name, checkboxFil[i].value)
        }
      }
    }
  }
  filter()

  const price = $("[value='allowance']")
  const toPrice = $('#to-price')
  const fromPrice = $('#from-price')

  fromPrice.oninput = () => {
    filterUrl.set('from-price', fromPrice.value)
    price.checked = false
    filterUrl.delete('price')
  }

  toPrice.oninput = () => {
    filterUrl.set('to-price', toPrice.value)
    price.checked = false
    filterUrl.delete('price')
  }

  price.onclick = () => {
    toPrice.value = ''
    fromPrice.value = ''
    filterUrl.delete('to-price')
    filterUrl.delete('from-price')
  }

  toPrice.value = filterUrl.get('to-price')
  fromPrice.value = filterUrl.get('from-price')

  $('#search-filter').onclick = () => {
    location.href = `?${filterUrl}`
  }

  const trendSearches = $('.trend-searches')

  if (TX(trendSearches).length > 5) {
    const trends = JSON.parse(TX(trendSearches))

    let trendSearch = ''
    for (const i in trends) {
      url.set('search', trends[i])
      trendSearch += `<li><a href='/design/ads/?${url}'>${trends[i]}</a></li>`
    }

    I(
      trendSearches,
      (ar ? 'عمليات البحث الشائعة:' : 'popular searches:') + trendSearch
    )
  } else {
    trendSearches.classList.add('none')
  }

  $('#save-search').onclick = (r) => {
    if (checkLog) {
      toggle('log', 'flex')
    } else {
      fetch(
        `/design/components/head.php?${
          r.target.dataset.search
        }=${encodeURIComponent(locSearch.slice(1))}`
      )
      if (r.target.innerHTML.includes('heart.svg')) {
        r.target.dataset.search = 'remove-search'
        I(r.target, `<img alt="" src="../icons/heart-fill.svg">${trans('save')}`)
      } else {
        r.target.dataset.search = 'search'
        I(r.target, `<img alt="" src="../icons/heart.svg">${trans('save')}`)
      }
    }
  }

  const searchInput = $('#find-location')
  const namesFromDOM = $$('.filter-location-in >div:not(:first-of-type) a')

  searchInput.addEventListener('keyup', (event) => {
    for (const nameElement of namesFromDOM) {
      if (
        TX(nameElement).toLowerCase().includes(event.target.value.toLowerCase())
      ) {
        nameElement.style.display = 'block'
        nameElement.parentElement.classList.add('block')
      } else {
        nameElement.style.display = 'none'
      }
      if (!searchInput.value) {
        nameElement.parentElement.classList.remove('block')
      }
    }
  })
}

// //////////////// END ads.js

// //////////////// START SELL.js

if (currentUrl.includes('/sell/')) {
  const adDir = $('#directory')
  const uploaded = $('#uploaded')
  const brandHead = $('#brand')
  const brand = $('.brand')

  function ifBrand () {
    if (brands.length) {
      let t = ''
      for (const i in brands) {
        t += `<label><input type='radio' name='brand' value='${replaceChar(
          brands[i]
        )}'>${trans(brands[i])}</label>`
      }
      I(brand, t)
      brandHead.classList.remove('none')
    } else {
      brandHead.classList.add('none')
    }
    dataList()
  }

  if (adId.value) {
    const valAdDir = TX(adDir).toLowerCase().split(' / ')
    const saveC = $('.saveCategory')
    let saveCat = ''

    if (valAdDir[0]) {
      saveCat += `<input type='checkbox' checked name='category' value='${valAdDir[0]}'>`
    }
    if (valAdDir[1]) {
      saveCat += `<input type='checkbox' checked name='subcategory' value='${valAdDir[1]}'>`
    }
    if (valAdDir.length === 4) {
      saveCat += `<input type='checkbox' checked name='branch' value='${valAdDir[2]}'><input type='checkbox' checked name='type' value='${valAdDir[3]}'>`
    } else {
      if (valAdDir[2]) {
        saveCat += `<input type='checkbox' checked name='type' value='${valAdDir[2]}'>`
      }
    }

    I(adDir, valAdDir.map((r) => (r = trans(r))).join(' / '))
    I(saveC, saveCat)

    allSubCategories(valAdDir[1])

    ifBrand()

    const photos = $('.listen-images')
    uploaded.value = TX(photos)
    const photosS = TX(photos).split(' -^- ')

    let s = ''

    for (let i = 1; i < photosS.length; i++) {
      s += `<label><input type='radio' name='ad-image' value='${i}'><img alt="" src='../uploads/${photosS[i]}'></label>`
    }

    I(photos, s)

    const photosIn = photos.querySelectorAll('input')
    const t = photosIn[parseInt(photosS[0])]

    if (t) {
      t.checked = true
    }

    if (photosIn.length) {
      for (const i of photosIn) {
        i.oninput = (r) => {
          uploaded.value = `${r.target.value - 1} -^- ${photosS
            .slice(1)
            .join(' -^- ')}`
        }
      }
    }

    const edTitle = $('#listen-title')
    edTitle.value = edTitle.value.replace(/-\d+/g, '')

    $$('.sell-top h3').forEach((r) => {
      T(r, ar ? 'تعديل إعلانك' : 'edit your ad')
    })
    T($('.submit'), ar ? 'عدل الآن' : 'edit now')
    T(
      $('.sell-form div:last-of-type h3'),
      ar ? 'تعديل بعض المعلومات:' : 'edit some information:'
    )
  }

  const inputAdImages = $('#input-listen-images')
  const contImages = $('#images-cont')

  const messageGallery = doc.createElement('div')
  messageGallery.classList.add('listen-images')

  const imagesOut = $('.listen-images-out')

  inputAdImages.onchange = (event) => {
    imagesOut.classList.add('v-none')
    uploaded.value = ''
    let s = ''
    for (let i = 0; i < inputAdImages.files.length; i++) {
      if (i <= 20) {
        const a = URL.createObjectURL(event.target.files[i])
        s += `<label><input type='radio' name='ad-image' value='${i}'><img alt="" src='${a}'></label>`
      }
    }

    I(messageGallery, s)
    contImages.appendChild(messageGallery)

    messageGallery.querySelector('input').checked = true
  }

  checkLength('listen-title', 5, 70)
  checkLength('listen-description', 20, 4200)

  const categ = $$('.parent-click >a, .nav-links> div>a')

  for (let i = 0; i < categ.length; i++) {
    I(
      categ[i],
      `<label><input type='radio' name='category' value='${categ[i].id}'>${TX(
        categ[i]
      )}</label>`
    )
  }

  const ca = $("[value='allowance']")
  const ct = $("[name='installment']")

  const cr = $('#listen-price')

  cr.oninput = () => {
    ca.checked = false
  }
  ca.onclick = () => {
    cr.removeAttribute('required')
    cr.value = ''
    ct.checked = false
  }
  ct.onclick = () => {
    cr.removeAttribute('required')
    ca.checked = false
  }

  const adType = $('.type')
  const branchIn = $('.branch')

  adType.onmouseleave = () => {
    remove('.parent.none', 'flex')
  }

  radInput('radio', '', 'statusIn', 1, 'status')
  radInput('radio', '', 'location', 1)
  radInput('radio', '', 'area', 1)

  let categoryValue = ''

  const c = $$('.parent-click a input,.nav-links > div > a input')
  for (let i = 0; i < c.length; i++) {
    c[i].onclick = () => {
      categoryValue = c[i].value
      allCategories(categoryValue)
    }
  }

  let subCategoryValue = ''

  const categIn = $$('.parent-click .click-show a, .nav-links div div a')

  const radios = $$(
    '.type input, .branch input, .brand input, .statusIn input'
  )

  function rem () {
    for (const i of radios) {
      i.checked = false
    }
  }

  function noneIN () {
    $('.parent.none div').innerHTML +=
      "<input type='radio' name='branch' value='' checked><input type='radio' checked name='type' value=''>"
  }

  function ti () {
    add('.categ', 'v-none')
    remove('.sell-form', 'v-none')
    add('.sell-form', 'block')
  }

  for (let i = 0; i < categIn.length; i++) {
    categIn[i].onclick = () => {
      rem()

      subCategoryValue = categIn[i].id

      allSubCategories(subCategoryValue)

      if (branch.length) {
        add('.parent.none', 'flex')
        add('.branch', 'block')
        remove('.type', 'block')

        let s = ''
        for (const i in branch) {
          s += `<a><label><input type='radio' name='branch' value='${replaceChar(
            branch[i]
          )}'>${trans(branch[i])}</label></a>`
        }

        I(branchIn, s)

        const selectBranch = branchIn.querySelectorAll('label')

        for (const i in branch) {
          selectBranch[i].onclick = () => {
            rem()

            const branch = selectBranch[i].querySelector('input').value
            allBranches(branch)

            let s = ''
            if (types.length) {
              for (const e in types) {
                s += `<a><label><input type='radio' name='type' value='${replaceChar(
                  types[e]
                )}'>${trans(types[e])}</label></a>`
              }

              I(adType, s)

              const selectType = $$('.type label')
              for (const e of selectType) {
                add('.type', 'block')

                e.onclick = () => {
                  ti()
                  T(
                    adDir,
                    `${trans(categoryValue)} / ${trans(subCategoryValue)} / ${trans(branch)} / ${trans(e.querySelector('input').value)} / `)
                }
              }
            } else {
              noneIN()
              ti()
              T(
                adDir,
                `${trans(categoryValue)} / ${trans(subCategoryValue)} / ${trans(branch)} / `
              )
            }
          }
        }
      } else {
        noneIN()
        if (types.length) {
          add('.parent.none', 'flex')
          add('.type', 'block')
          remove('.branch', 'block')

          let s = ''
          for (const i in types) {
            s += `<a><label><input type='radio' name='type' value='${replaceChar(types[i])}'>${trans(types[i])}</label></a>`
          }
          I(adType, s)

          const selectType = adType.querySelectorAll('input')
          for (const i in types) {
            selectType[i].onclick = () => {
              ti()
              T(adDir, `${trans(categoryValue)} / ${trans(subCategoryValue)} / ${trans(selectType[i].value)} /`
              )
            }
          }
        } else {
          noneIN()
          T(adDir, `${trans(categoryValue)} / ${trans(subCategoryValue)} / `)
          ti()
        }
      }

      ifBrand()
    }

    I(
      categIn[i],
      `<label><input type='radio' name='subcategory' value='${
        categIn[i].id
      }'>${TX(categIn[i])}</label>`
    )
  }

  $$('.return').forEach((s) => {
    s.onclick = () => {
      toggle('.sell-form', 'block')
      toggle('.categ', 'v-none')
      types = []
      brands = []
      branch = []
      remove('.parent.none', 'flex')
    }
  })

  const clickShowS = $$('.click-show')

  for (const i of clickShowS) {
    i.onmouseleave = () => {
      types = []
      brands = []
      branch = []

      i.classList.remove('block')
    }
  }

  dataList()
}

// //////////////// END SELL.js

// //////////////// START ad.js

const listenSms = $('#listen-sms')

const adPage = currentUrl.includes('/ad/')
if (adPage) {
  // // Start ad gallery

  const images = $('.listen-images-in')
  const imagesText = TX(images).split(' -^- ')

  let imagesRes = ''
  for (let i = 0; i < imagesText.length; i++) {
    if (i !== 0) {
      imagesRes += `<img alt="" src='../uploads/${imagesText[i]}'>`
    }
  }

  I(images, imagesRes)

  // / //////////////////////////////

  const description = $('#description')

  const vr = $('#description')
  const st = $('#description + .textClick')

  vr.classList.add('show-more')

  if (TX(description).length >= 252) {
    st.onclick = () => {
      if (TX(st) !== trans('show more')) {
        vr.classList.add('show-more')
        T(st, trans('show more'))
      } else {
        vr.classList.toggle('show-more')
        T(st, trans('show less'))
      }
    }
  } else {
    st.classList.add('none')
  }

  $$('.favorite-num span').forEach((s) => {
    if (TX(s) <= 1) {
      s.remove()
    }
  })

  if (!$('.favorite-num span')) {
    $('.favorite-num').remove()
  }

  const a = TX($('#ad-id'))
  const chat = $$('.chatAd')
  if (chat) {
    chat.forEach((r) => {
      r.href += a
    })
  }

  let as = 0
  const s = TX($('h1.listen-title'))
  const fixTit = s.length > 40 ? s.slice(0, 40) + '...' : s

  const showPho = $('#show-PhNu')

  if (showPho) {
    const phone = $('#listen-call').href.slice(4)

    listenSms.href = `sms:+20${phone}?body=${encodeURIComponent(
      ar
        ? 'متاحًا؟ "' + fixTit + '" مرحبًا، هل لا يزال الإعلان '
        : `Hello, is the ad "${fixTit}" still available?`
    )}`

    showPho.onclick = (r) => {
      T(r.target, phone)
      if (as === 0) {
        fetch(`/design/components/head.php?ad-id=${a}&show-number=on`)
      }
      as = 1
    }
  }
}

if (adPage || pathname === '/design/') {
  const s = $$('.listen-images-in img')
  const galleryImages = Array.from(s)

  const adSmallImages = $('#listen-small-image')

  const imageNumbers = $('#listen-image-numbers')

  const nextButton = $('#nextButton')
  const prevButton = $('#prevButton')

  // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

  let currentImg = 0

  if (adPage) {
    let i = 0
    for (; i < galleryImages.length;) {
      adSmallImages.append(galleryImages[i].cloneNode())
      i++
    }
  }

  const smallImages = Array.from($$('#listen-small-image img'))

  if (smallImages[0]) {
    function checker () {
      I(imageNumbers, `${currentImg + 1} / ${galleryImages.length}`)

      for (let i = 0; i < galleryImages.length; i++) {
        galleryImages[i].parentElement.classList.remove('active')
        galleryImages[i].classList.remove('active')
        if (adPage) {
          smallImages[i].classList.remove('active')
        }

        function indexSmallImg () {
          clearInterval(autoSlide)
          currentImg = smallImages.indexOf(smallImages[i])
          checker()
        }

        if (adPage) {
          smallImages[i].onclick = () => {
            indexSmallImg()
          }
        }
      }
      if (adPage) {
        smallImages[currentImg].classList.add('active')
      }
      galleryImages[currentImg].classList.add('active')
      galleryImages[currentImg].parentElement.classList.add('active')
    }

    function next () {
      if (currentImg === galleryImages.length - 1) {
        currentImg = 0
        checker()
      } else {
        currentImg++
        checker()
      }
    }
    function prev () {
      if (currentImg === 0) {
        currentImg = galleryImages.length - 1
        checker()
      } else {
        currentImg--
        checker()
      }
    }

    const autoSlide = setInterval(next, 2500)

    nextButton.onclick = () => {
      next()
      clearInterval(autoSlide)
    }

    prevButton.onclick = () => {
      prev()
      clearInterval(autoSlide)
    }

    checker()

    if (s.length === 1) {
      nextButton.style.display = 'none'
      prevButton.style.display = 'none'
      adSmallImages.style.display = 'none'
    }
  }
}

// //////////////// END ad.js

if (currentUrl.includes('/user/') || adPage) {
  const shareFB = $('#shareFB')
  const shareTW = $('#shareTW')
  const shareWA = $('#shareWA')
  const shareMS = $('#shareMS')

  shareTW.setAttribute(
    'href',
    `https://twitter.com/intent/tweet?url=${doc.URL}&via=${location.hostname}`
  )

  let shareFBMob = ''
  if (isMobile()) {
    // shareFBMob = 'https://m.facebook.com/sharer.php?u='
    // shareFBMob = 'fb-share-link://share?link='
    // shareFBMob = 'fb://faceweb/f?href='
    shareFBMob = 'fb://share?link='
  } else {
    shareFBMob = 'https://www.facebook.com/share_channel/?link='
  }

  shareFB.setAttribute('href', shareFBMob + doc.URL)

  let shareMSMob = ''
  if (isMobile()) {
    shareMSMob = 'fb-messenger://share/?link='
  } else {
    shareMSMob = 'https://www.facebook.com/dialog/share?link='
  }

  shareMS.setAttribute('href', shareMSMob + doc.URL)

  let shareWAMob = ''
  if (isMobile()) {
    shareWAMob = 'whatsapp://send?text='
  } else {
    shareWAMob = 'https://api.whatsapp.com/send/?text='
  }

  shareWA.setAttribute('href', shareWAMob + doc.URL)
}

if (currentUrl.includes('/user/')) {
  const phone = $('.listen-call').id
  $('#show-PhNu').onclick = () => {
    T($('#show-PhNu-sh'), ` ${phone}`)
  }
  listenSms.href = `sms:+20${phone}?body=${encodeURIComponent(
    `${ar ? 'مرحباً' : 'Hello'}, ${TX($('main .listen-seller b'))}`
  )}`
}

if (currentUrl.includes('/mysettings/')) {
  valNewPass('editPass', 'editPassTwo')
}

home()

const favorites = $$('.card-fav, .card-fav-fill')
for (const i of favorites) {
  i.onclick = (r) => {
    if (checkLog) {
      toggle('.log', 'flex')
      r.preventDefault()
    } else {
      const s = r.target.baseURI.includes('/mysearches/')
      fetch(`/design/components/head.php?${i.name}=${i.value}`)

      if (i.classList.contains('card-fav')) {
        if (s) {
          i.name = 'remove-search'
        } else {
          i.name = 'remove'
        }
        i.classList.remove('card-fav')
        i.classList.add('card-fav-fill')
      } else {
        if (s) {
          i.name = 'search'
        } else {
          i.name = 'id'
        }
        i.classList.remove('card-fav-fill')
        i.classList.add('card-fav')
      }
    }
  }
}

if (
  checkLog &&
  currentUrl.search(
    /(\/sell\/|\/mysettings\/|\/mysearches\/|\/myfavorites\/|\/myads\/|\/chat\/)/
  ) > 0
) {
  toggle('form.sell, #settings .sell-form', 'hidden')
  toggle('.log', 'flex')
}

if ($('.log')) {
  const foot = ar
    ? '<p>من خلال تسجيل الدخول، فإنك توافق على <a href="/design/usecondetions/">شروط الاستخدام</a> و <a href="/design/privacy/">سياسة الخصوصية</a> الخاصة بأمازون.</p>'
    : '<p>by logging in, you agree to amazon\'s <a href="/design/usecondetions/">terms of use</a> and <a href="/design/privacy/">privacy policy</a>.</p>'
  function signInF (form) {
    const head = ar
      ? `<span onclick="toggle('${form}','flex')"><img src="/design/icons/x.svg" alt="${trans(
          'Close'
        )}"></span><img alt="${trans(
          'Amazon'
        )}" src="/design/images/android-chrome-192x192.png" class="invert" width="100" height="100"><p>مرحبًا بك في أمازون</p>`
      : `<span onclick="toggle('${form}','flex')"><img src="/design/icons/x.svg" alt="${trans(
          'Close'
        )}"></span><img alt="${trans(
          'Amazon'
        )}" src="/design/images/android-chrome-192x192.png" class="invert" width="100" height="100"><p>hello, welcome to amazon</p>`
    I($(form), `${head + $(form).innerHTML + foot}`)
  }

  signInF('.log')
  signInF('.create-acc')

  valNewPass('new-password', 'retype-password')
}
