// アナログストップウォッチの機能を実装するスクリプト

// DOM要素の取得
const hand = document.querySelector("#hand");
const startBtn = document.getElementById("startBtn");
const stopBtn = document.getElementById("stopBtn");
const resetBtn = document.getElementById("resetBtn");

// 変数の初期化
let seconds = 0;       // 経過秒数
let intervalId = null; // setIntervalのID

// 秒針を回転させる関数
function rotateHand(seconds) {
  // 1秒あたり6度回転（360度÷60秒）
  const degree = (seconds % 60) * 6;
  hand.style.transform = `rotate(${degree}deg)`;
}

// スタートボタンの処理
startBtn.addEventListener("click", () => {
  // 既に動いている場合は何もしない
  if (intervalId !== null) return;
  
  // 1秒ごとに実行
  intervalId = setInterval(() => {
    seconds++;
    rotateHand(seconds);
  }, 1000);
});

// ストップボタンの処理
stopBtn.addEventListener("click", () => {
  // 動いていない場合は何もしない
  if (intervalId === null) return;
  
  // タイマーを停止
  clearInterval(intervalId);
  intervalId = null;
});

// リセットボタンの処理
resetBtn.addEventListener("click", () => {
  // タイマーを停止
  if (intervalId !== null) {
    clearInterval(intervalId);
    intervalId = null;
  }
  
  // 秒数をリセット
  seconds = 0;
  
  // 秒針を0の位置に戻す
  rotateHand(0);
});

// 初期状態で秒針を0の位置に設定
rotateHand(0);
