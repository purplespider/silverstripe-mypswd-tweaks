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
						<td style="padding: 30px 40px; border-bottom: 3px solid #5EBC4B;">
							<h1 style="margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; font-size: 24px; font-weight: 600; color: #333333; text-align: left;">
								Password Changed Successfully
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
								This email confirms that your password for <strong>$SiteConfig.Title</strong> has been successfully changed.
							</p>

							<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 25px 0; padding: 15px; background-color: #d4edda; border-left: 4px solid #5EBC4B; border-radius: 4px;">
								<tr>
									<td style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; font-size: 14px; color: #155724;">
										<strong>Account:</strong> $Email<br>
										<strong>Changed:</strong> <% with $Now %><% if $Nice %>$Nice<% else %>Just now<% end_if %><% end_with %>
									</td>
								</tr>
							</table>

							<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 25px 0; padding: 15px; background-color: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px;">
								<tr>
									<td style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; font-size: 14px; color: #856404;">
										<strong>Didn't make this change?</strong><br>
										If you didn't change your password, your account may have been compromised. Please reset your password immediately using the button below.
									</td>
								</tr>
							</table>

							<!-- CTA Button -->
							<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 30px 0;">
								<tr>
									<td align="center">
										<a href="{$AbsoluteBaseURL}Security/changepassword" style="display: inline-block; padding: 14px 32px; background-color: #C8122C; color: #ffffff; text-decoration: none; font-weight: 600; font-size: 16px; border-radius: 6px;">
											Reset My Password Now
										</a>
									</td>
								</tr>
							</table>

							<p style="margin: 0 0 20px; color: #555555; font-size: 14px; text-align: center;">
								<a href="{$AbsoluteBaseURL}Security/changepassword" style="color: #015A93; word-break: break-all;">{$AbsoluteBaseURL}Security/changepassword</a>
							</p>

							<p style="margin: 25px 0 0; color: #888888; font-size: 13px;">
								For your security, we recommend using a strong, unique password and enabling two-factor authentication if available.
							</p>
						</td>
					</tr>
					<!-- Footer -->
					<tr>
						<td style="padding: 25px 40px; background-color: #f8f9fa; border-top: 1px solid #e0e0e0;">
							<p style="margin: 0 0 8px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; font-size: 13px; line-height: 1.6; color: #888888; text-align: center;">
								This is an automated security notification from <a href="$AbsoluteBaseURL" style="color: #015A93; text-decoration: none; font-weight: 500;">$SiteConfig.Title</a>
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
