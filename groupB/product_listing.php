<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>出品フォーム（ワイヤー再現）</title>
<style>
 :root{
   --accent:#4DE07A;
   --muted:#eee;
   --border:#cfcfcf;
   --danger:#e74c3c;
   --maxWidth:1000px;
   font-family: "Hiragino Kaku Gothic ProN","Noto Sans JP",system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
 }
 body{
   display:flex;
   justify-content:center;
   padding:24px;
   background:#fff;
   color:#222;
 }
 .container{
   width:100%;
   max-width:var(--maxWidth);
   display:flex;
   gap:24px;
   align-items:flex-start;
 }
 /* 左：画像カラム */
 .left{
   width:28%;
   min-width:180px;
   display:flex;
   flex-direction:column;
   gap:18px;
 }
 .drop-hint{font-size:13px;color:#666;margin-bottom:6px;}
 .image-slot{
   background:var(--muted);
   border:2px dashed #ddd;
   height:120px;
   display:flex;
   align-items:center;
   justify-content:center;
   border-radius:6px;
   position:relative;
   overflow:hidden;
 }
 .image-slot img{width:100%;height:100%;object-fit:cover;}
 .image-slot .icon{
   font-size:28px;color:#888;
 }
 .small-note{font-size:12px;color:#999;margin-top:4px;}
 /* 右：フォーム */
 .right{
   flex:1;
   border:2px solid var(--border);
   padding:22px;
   border-radius:4px;
   box-sizing:border-box;
   min-width:300px;
 }
 .form-title{
   text-align:center;
   font-size:22px;
   margin-bottom:12px;
   font-weight:700;
 }
 .field{
   margin:18px 0;
 }
 label{display:block;font-size:20px;margin-bottom:8px;font-weight:700;text-align:center;}
 input[type="text"], input[type="number"], textarea, select{
   width:100%;
   box-sizing:border-box;
   border:2px solid var(--border);
   padding:12px 14px;
   border-radius:8px;
   font-size:15px;
   outline:none;
 }
 .price-row{display:flex;align-items:center;gap:12px;}
 .price-row input{flex:1;}
 .price-hint{font-size:12px;color:#d33;margin-top:6px;text-align:right;}
 .char-count{font-size:12px;color:#999;text-align:right;margin-top:6px;}
 select.genre{height:110px;border-radius:8px;padding:10px;}
 .submit-wrap{display:flex;flex-direction:column;align-items:center;gap:8px;margin-top:14px;}
 .btn-submit{
   background:var(--accent);
   border:none;
   padding:12px 40px;
   border-radius:10px;
   font-size:20px;
   font-weight:700;
   color:#fff;
   cursor:pointer;
 }
 .error{color:var(--danger);font-weight:700;font-size:14px;margin-top:6px;}
 .hidden{display:none;}
 /* responsive */
 @media(max-width:800px){
   .container{flex-direction:column;}
   .left{width:100%;flex-direction:row;flex-wrap:wrap;}
   .image-slot{flex:1 1 calc(50% - 12px);height:110px;}
   .right{width:100%;}
 }
</style>
</head>
<body>
<div class="container" role="main">
<!-- 左：画像 -->
<div class="left" aria-label="画像アップロード">
<div class="drop-hint">
<a href="homePage.html" style="text-decoration:none;color:#666;font-weight:700;">&lt; ホームへ</a><br>
  画像アイコンタップで画像を選択（最大四枚）
</div>
 
<!-- 4スロット -->
<div class="image-slot" data-index="0">
<span class="icon">🖼️</span>
</div>
<div class="image-slot" data-index="1">
<span class="icon">🖼️</span>
</div>
<div class="image-slot" data-index="2">
<span class="icon">🖼️</span>
</div>
<div class="image-slot" data-index="3">
<span class="icon">🖼️</span>
</div>
<div class="small-note">タップで画像を選択、ドラッグ&ドロップ可。最大4枚まで。</div>
<!-- hidden file input -->
<input id="file-input" type="file" accept="image/*" multiple class="hidden" />
</div>
<!-- 右：フォーム -->
<form class="right" id="product-form" novalidate>
<div class="form-title">商品出品</div>
<div class="field">
<label for="name">商品名</label>
<input id="name" type="text" maxlength="20" placeholder="例：レトロゲームソフト" required />
<div class="char-count" id="name-count">0/20</div>
</div>
<div class="field">
<label for="price">販売価格</label>
<div class="price-row">
<input id="price" type="number" min="300" max="99999" step="1" placeholder="300" required />
<div style="min-width:48px;text-align:right;font-weight:700;">円</div>
</div>
<div class="price-hint" id="price-hint">¥300〜¥99,999まで可能</div>
</div>
<div class="field">
<label for="genre">ジャンル</label>
<select id="genre" class="genre" size="4">
<option>ゲーム</option>
<option>アニメ</option>
<option>アイドル</option>
<option>ブランド</option>
</select>
</div>
<div class="field">
<label for="desc">商品説明</label>
<textarea id="desc" rows="3" maxlength="140" placeholder="状態・付属品などを詳しく"></textarea>
<div class="char-count" id="desc-count">0/140</div>
</div>
<div class="field">
<label for="condition">商品状態</label>
<textarea id="condition" rows="2" maxlength="40" placeholder="例：目立つ傷なし"></textarea>
<div class="char-count" id="cond-count">0/40</div>
</div>
<div class="submit-wrap">
<button type="submit" class="btn-submit">出品</button>
<div id="form-error" class="error hidden">* エラーメッセージ</div>
</div>
</form>
</div>
<script>
 // --- 画像アップロード（最大4枚・プレビュー） ---
 const fileInput = document.getElementById('file-input');
 const slots = Array.from(document.querySelectorAll('.image-slot'));
 let images = [null,null,null,null]; // FileまたはdataURL
 // slotクリックでファイル選択（複数）／ドラッグも対応
 slots.forEach(slot=>{
   const idx = Number(slot.dataset.index);
   // click -> open file selector (allow multiple)
   slot.addEventListener('click', ()=> {
     fileInput.click();
     // remember which index clicked: store on input dataset
     fileInput.dataset.startIndex = idx;
   });
   // drag/drop
   slot.addEventListener('dragover', e=>{ e.preventDefault(); slot.style.borderColor='#aaa'; });
   slot.addEventListener('dragleave', e=>{ slot.style.borderColor=''; });
   slot.addEventListener('drop', e=>{
     e.preventDefault(); slot.style.borderColor='';
     handleFiles(Array.from(e.dataTransfer.files));
   });
 });
 fileInput.addEventListener('change', e=>{
   const files = Array.from(e.target.files);
   handleFiles(files);
   fileInput.value = ""; // 同じファイル選び直し対応
 });
 function handleFiles(files){
   if(!files.length) return;
   // startIndex indicates where to place first selected
   let start = fileInput.dataset.startIndex ? Number(fileInput.dataset.startIndex) : 0;
   for(const f of files){
     if(!f.type.startsWith('image/')) continue;
     // find next free slot starting at start
     let i = start;
     while(i<4 && images[i]!==null) i++;
     if(i>=4){
       alert('最大4枚までです。');
       break;
     }
     const reader = new FileReader();
     reader.onload = (ev)=>{
       images[i] = ev.target.result; // dataURL
       renderSlot(i);
     };
     reader.readAsDataURL(f);
     start = i+1;
   }
 }
 function renderSlot(i){
   const slot = slots[i];
   slot.innerHTML = '';
   const img = document.createElement('img');
   img.src = images[i];
   slot.appendChild(img);
   // add remove button overlay
   const btn = document.createElement('button');
   btn.type = 'button';
   btn.textContent = '×';
   btn.style.position='absolute';
   btn.style.top='6px';
   btn.style.right='6px';
   btn.style.background='rgba(255,255,255,0.8)';
   btn.style.border='none';
   btn.style.borderRadius='50%';
   btn.style.width='28px';
   btn.style.height='28px';
   btn.style.cursor='pointer';
   btn.style.fontWeight='700';
   btn.addEventListener('click', (e)=>{
     e.stopPropagation();
     images[i]=null;
     slot.innerHTML = '<span class="icon">🖼️</span>';
   });
   slot.appendChild(btn);
 }
 // --- 文字数カウント ---
 const nameInput = document.getElementById('name');
 const nameCount = document.getElementById('name-count');
 const desc = document.getElementById('desc');
 const descCount = document.getElementById('desc-count');
 const cond = document.getElementById('condition');
 const condCount = document.getElementById('cond-count');
 nameInput.addEventListener('input', ()=> nameCount.textContent = `${nameInput.value.length}/20`);
 desc.addEventListener('input', ()=> descCount.textContent = `${desc.value.length}/140`);
 cond.addEventListener('input', ()=> condCount.textContent = `${cond.value.length}/40`);
 // --- 価格バリデーション ---
 const price = document.getElementById('price');
 const priceHint = document.getElementById('price-hint');
 price.addEventListener('input', ()=>{
   const v = Number(price.value);
   if(!price.value) {
     priceHint.textContent = '¥300〜¥99,999まで可能';
     priceHint.style.color = '#d33';
     return;
   }
   if(Number.isNaN(v) || v < 300 || v > 99999){
     priceHint.textContent = '価格は¥300〜¥99,999の範囲で入力してください';
     priceHint.style.color = '#d33';
   } else {
     priceHint.textContent = '';
   }
 });
 // --- フォーム送信（バリデーション） ---
 const form = document.getElementById('product-form');
 const formError = document.getElementById('form-error');
 form.addEventListener('submit', (e)=>{
   e.preventDefault();
   formError.classList.add('hidden');
   formError.textContent = '';
   const errors = [];
   if(!nameInput.value.trim()) errors.push('商品名を入力してください。');
   if(nameInput.value.trim().length > 20) errors.push('商品名は20文字以内にしてください。');
   const p = Number(price.value);
   if(!price.value) errors.push('販売価格を入力してください。');
   else if(Number.isNaN(p) || p < 300 || p > 99999) errors.push('価格は¥300〜¥99,999の範囲で入力してください。');
   if(!desc.value.trim()) errors.push('商品説明を入力してください。');
   if(!cond.value.trim()) errors.push('商品状態を入力してください。');
   // optional: at least 1 image
   const anyImage = images.some(x=>x !== null);
   if(!anyImage) errors.push('画像を1枚以上アップロードしてください。');
   if(errors.length){
     formError.innerHTML = errors.map(s=>`・${s}`).join('<br>');
     formError.classList.remove('hidden');
     window.scrollTo({top:0,behavior:'smooth'});
     return;
   }

// success -> assemble data preview (mock submit)
const data = {
  name: nameInput.value.trim(),
  price: p,
  genre: document.getElementById('genre').value,
  desc: desc.value.trim(),
  condition: cond.value.trim(),
  imagesCount: images.filter(x=>x!==null).length
};

// --- ここから変更 ---
 // 商品情報を URL パラメータで確認画面へ渡す例
 const params = new URLSearchParams(data).toString();

 // 確認画面へ遷移
 window.location.href = `product_listing_confirmation.php?${params}`;
 // --- ここまで変更 ---


 });
</script>
</body>
</html>