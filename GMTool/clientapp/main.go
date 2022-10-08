package main

import (
	"image/color"
	"log"

	"fyne.io/fyne/v2"
	"fyne.io/fyne/v2/app"
	"fyne.io/fyne/v2/canvas"
	"fyne.io/fyne/v2/layout"

	"fyne.io/fyne/v2/container"

	"fyne.io/fyne/v2/widget"
)

func main() {
	a := app.New()
	w := a.NewWindow("RoomCheck")
	// 00の小ネタ作品

	// 入室チェックタイトルを設定
	titleLabel := widget.NewLabel("Please Room Password")
	titleLabel.MinSize()

	backgroundColor := color.NRGBA{R: 0, G: 110, B: 30, A: 255}

	// 深緑の内容を設定
	rect := canvas.NewRectangle(backgroundColor)

	backGroundContainer := container.New(
		layout.NewGridWrapLayout(fyne.NewSize(500, 800)),
		rect)

	roomExecButton := widget.NewButton("OK", func() {
		log.Println("ok")
	})
	roomExecButton.Resize(fyne.NewSize(100, 200))
	backGroundContainer.Add(roomExecButton)

	roomExecButton.Move(fyne.Position{200.0, 400.0})

	// 扉を開けるときに入力している暗号画面のお話

	// 入室するパスワードの内容を表示

	// ボタンを押すと、１文字描画されて次へ進む

	// ボタンを押す前と押した後で、色を変更する

	// キャンバス全体のサイズを設定
	w.Resize(fyne.NewSize(500, 880))
	appCanvas := w.Canvas()
	appCanvas.SetContent(container.NewHBox(
		backGroundContainer,
	))
	w.ShowAndRun()

	// OKボタンを押した場合に、一致している場合はドア解除をする

}
