<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<% base_tag %>
</head>
<body style="margin: 0; padding: 0; background-color: #f5f5f5;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f5f5f5;">
		<tr>
			<td align="center" style="padding: 50px 20px;">
				<!-- Main Container -->
				<table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
					<!-- Header -->
					<tr>
						<td style="padding: 30px 40px; border-bottom: 3px solid #015A93;">
							<h1 style="margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; font-size: 24px; font-weight: 600; color: #333333; text-align: left;">
								Password Reset Request
							</h1>
						</td>
					</tr>
					<!-- Content -->
					<tr>
						<td style="padding: 40px 40px 30px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; font-size: 16px; line-height: 1.7; color: #333333;">
							<p style="margin: 0 0 20px; font-size: 16px; color: #333333;">
								Hi <strong>$FirstName</strong>,
							</p>

							<p style="margin: 0 0 20px; color: #555555;">
								We received a request to reset your password for <strong>$SiteConfig.Title</strong>. Click the button below to create a new password:
							</p>

							<!-- CTA Button -->
							<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 30px 0;">
								<tr>
									<td align="center">
										<a href="$PasswordResetLink" style="display: inline-block; padding: 14px 32px; background-color: #015A93; color: #ffffff; text-decoration: none; font-weight: 600; font-size: 16px; border-radius: 6px;">
											Reset My Password
										</a>
									</td>
								</tr>
							</table>

							<p style="margin: 0 0 20px; color: #555555; font-size: 14px;">
								Or copy and paste this link into your browser:<br>
								<a href="$PasswordResetLink" style="color: #015A93; word-break: break-all;">$AbsoluteBaseURL$PasswordResetLink</a>
							</p>

							<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 25px 0; padding: 15px; background-color: #f8f9fa; border-left: 4px solid #6c757d; border-radius: 4px;">
								<tr>
									<td style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; font-size: 14px; color: #495057;">
										<strong>Didn't request this?</strong><br>
										If you didn't request a password reset, you can safely ignore this email. Your password will remain unchanged.
									</td>
								</tr>
							</table>

							<p style="margin: 25px 0 0; color: #888888; font-size: 13px;">
								This password reset link will expire in 24 hours for security reasons.
							</p>
						</td>
					</tr>
					<!-- Footer -->
					<tr>
						<td style="padding: 25px 40px; background-color: #f8f9fa; border-top: 1px solid #e0e0e0;">
							<p style="margin: 0 0 8px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; font-size: 13px; line-height: 1.6; color: #888888; text-align: center;">
								This is an automated message from <a href="$AbsoluteBaseURL" style="color: #015A93; text-decoration: none; font-weight: 500;">$SiteConfig.Title</a>
							</p>
							<p style="margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; font-size: 12px; color: #aaaaaa; text-align: center;">
								Please do not reply to this email.
							</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
