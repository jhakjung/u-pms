<?php

/**
 * The default email message that will be sent to users as they are approved.
 *
 * @return string
 */
function nua_default_approve_user_message() {
	$message = __( 'You have been approved to access {sitename}', 'new-user-approve' ) . "\r\n\r\n";
	$message .= "{username}\r\n\r\n";
	$message .= "{login_url}\r\n\r\n";
    $message .= __( 'To set or reset your password, visit the following address:', 'new-user-approve' ) . "\r\n\r\n";
    $message .= "{reset_password_url}";

	$message = apply_filters( 'new_user_approve_approve_user_message_default', $message );

	return $message;
}



/**
 * The default email message that will be sent to users as they are denied.
 *
 * @return string
 */
function nua_default_deny_user_message() {
	$message = __( 'You have been denied access to {sitename}.', 'new-user-approve' );

	$message = apply_filters( 'new_user_approve_deny_user_message_default', $message );

	return $message;
}

/**
 * The default message that will be shown to the user after registration has completed.
 *
 * @return string
 */
function nua_default_registration_complete_message() {
	$message = sprintf( __( '관리자가 승인 후 이용 가능합니다. 관리자가 이메일로 승인 알림을 보낼 것입니다.', 'new-user-approve' ) );
	$message .= ' ';
	$message .= sprintf( __( '(※ 승인 이메일 발송이 안될 수도 있으니, 승인 이메일이 오지 않으면 일정 시간 경과 후 로그인을 시도해보시고, 그래도 안되면 사이트 관리자에게 직접 문의하시기 바랍니다.', 'new-user-approve' ) );

	$message = apply_filters( 'new_user_approve_pending_message_default', $message );

	return $message;
}

function nua_auto_approve_message() {


	$message = sprintf( __( 'You have been approved to access {sitename}. You will receive an email with instructions on what you will need to do next. Thanks for your patience.

	', 'new-user-approve' ) );
	$message .= ' ';
	$message = apply_filters( 'new_user_approve_auto_approve_message', $message );

	return $message;

}




/**
 * The default welcome message that is shown to all users on the login page.
 *
 * @return string
 */
function nua_default_welcome_message() {
	$welcome = sprintf( __( '{sitename} 사이트에 오신 것을 환영합니다. 이 사이트는 승인된 사용자만이 접근 가능합니다. 가입을 원하시면 아래 회원가입을 누르세요. 회원 가입은 관리자 승인이 필요합니다.', 'new-user-approve' ), get_option( 'blogname' ) );

	$welcome = apply_filters( 'new_user_approve_welcome_message_default', $welcome );

	return $welcome;
}

/**
 * The default notification message that is sent to site admin when requesting approval.
 *
 * @return string
 */
function nua_default_notification_message() {
	$message = __( '{username} ({user_email}) has requested a username at {sitename}', 'new-user-approve' ) . "\n\n";
	$message .= "{site_url}\n\n";
	$message .= __( 'To approve or deny this user access to {sitename} go to', 'new-user-approve' ) . "\n\n";
	$message .= "{admin_approve_url}\n\n";

	$message = apply_filters( 'new_user_approve_notification_message_default', $message );

	return $message;
}

/**
 * The default message that is shown to the user on the registration page before any action
 * has been taken.
 *
 * @return string
 */
function nua_default_registration_message() {
	$message = __( '사용자명(영문과 숫자만 가능)과 이메일을 입력한 후 회원가입 버튼을 누르면 관리자에게 승인을 요청하게 됩니다.', 'new-user-approve' );

	$message = apply_filters( 'new_user_approve_registration_message_default', $message );

	return $message;
}

function nua_default_registeration_welcome_email() {
    $message  = __('Hello,', "new-user-approve") . "\r\n\r\n";

    $message .= __("Thank you for registering on our site. We have successfully received your request and is currently pending for approval.", "new-user-approve") . "\r\n";

    $message .= __("The administrator will review the information that has been submitted after which they will either approve or deny your request. You will receive an email with the instructions on what you will need to do next.", "new-user-approve") . "\r\n\r\n";

    $message .= __("Thank You", "new-user-approve");

    return $message;
}
