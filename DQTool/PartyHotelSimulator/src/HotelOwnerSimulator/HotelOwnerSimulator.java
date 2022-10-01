package HotelOwnerSimulator;

import org.eclipse.swt.SWT;
import org.eclipse.swt.graphics.Font;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Display;
import org.eclipse.swt.widgets.Label;
import org.eclipse.swt.widgets.Shell;

public class HotelOwnerSimulator {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		Display display = new Display ();
		Shell shell = new Shell(display);
		shell.setLayout(new GridLayout(1, true));
		shell.setText("ドラクエ宿屋おっちゃんシミュレータ");
		shell.setSize(600, 1000);
		Label titleLabel = GenerateLabel(shell, "宿屋のおっちゃん家計簿");
		titleLabel.setFont(GenerateFont(display, 25));
		titleLabel.setSize(200, 50);
		titleLabel.setLocation(30, 200);
		Label accountTitle = GenerateLabel(shell, "宿屋科目設定");
		accountTitle.setFont(GenerateFont(display, 25));
		Label saleApply = GenerateLabel(shell, "宿代反映");
		saleApply.setFont(GenerateFont(display, 25));
		Label receiptList = GenerateLabel(shell, "宿屋領収書一覧");
		receiptList.setFont(GenerateFont(display, 25));
		Label receiptAdd = GenerateLabel(shell, "宿屋費用入力");
		receiptAdd.setFont(GenerateFont(display, 25));
		Label monthBalanceSheet = GenerateLabel(shell, "月間収入確認");
		monthBalanceSheet.setFont(GenerateFont(display, 25));
		shell.open ();
		while (!shell.isDisposed ()) {
		if (!display.readAndDispatch ()) display.sleep ();
		}
		display.dispose (); 
	}
	
	public static Font GenerateFont(Display display, int size) {
		return new Font(display, "MS 明朝", size, SWT.BORDER);
	}
	
	public static Label GenerateLabel(Shell shell, String text) {
		Label label = new Label(shell, SWT.NULL);
		label.setText(text);
		return label;
	}

}
