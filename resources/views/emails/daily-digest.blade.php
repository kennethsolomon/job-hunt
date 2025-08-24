<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daily Job Hunt Digest</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6; color: #333; margin: 0; padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .container {
            max-width: 600px; margin: 0 auto; background: white;
            border-radius: 16px; overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .header {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white; padding: 40px 30px; text-align: center;
        }
        .header h1 { margin: 0; font-size: 32px; font-weight: 700; }
        .header p { margin: 15px 0 0; opacity: 0.9; font-size: 18px; }
        .content { padding: 40px 30px; }
        .section { margin-bottom: 35px; }
        .section h2 {
            color: #2d3748; margin: 0 0 25px; font-size: 24px;
            font-weight: 600; display: flex; align-items: center;
        }
        .section h2 .icon { margin-right: 12px; font-size: 28px; }
        .item {
            background: #f8fafc; border-radius: 12px; padding: 25px;
            margin-bottom: 20px; border-left: 5px solid;
            transition: transform 0.2s ease;
        }
        .item:hover { transform: translateY(-2px); }
        .interview-item { border-left-color: #48bb78; }
        .task-item { border-left-color: #e53e3e; }
        .item-title {
            font-weight: 700; font-size: 20px;
            margin-bottom: 10px; color: #2d3748;
        }
        .item-company {
            color: #4a5568; font-size: 18px;
            margin-bottom: 8px; font-weight: 500;
        }
        .item-meta {
            color: #718096; font-size: 15px;
            margin-bottom: 6px; display: flex; align-items: center;
        }
        .time {
            background: #e6fffa; color: #047857;
            padding: 4px 12px; border-radius: 20px;
            font-weight: 600; font-size: 14px;
        }
        .overdue-badge {
            background: #fed7d7; color: #c53030;
            padding: 4px 12px; border-radius: 20px;
            font-weight: 600; font-size: 14px;
        }
        .stats {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; border-radius: 12px; padding: 25px;
            text-align: center; margin-bottom: 30px;
        }
        .stats h3 { margin: 0 0 15px; font-size: 20px; }
        .no-content {
            text-align: center; padding: 60px 20px;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            border-radius: 12px;
        }
        .no-content h2 { color: #2d3748; margin-bottom: 15px; }
        .cta {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; padding: 15px 30px; border-radius: 30px;
            text-decoration: none; display: inline-block;
            margin-top: 25px; font-weight: 600; font-size: 16px;
            transition: transform 0.2s ease;
        }
        .cta:hover { transform: scale(1.05); }
        .footer {
            background: #f7fafc; padding: 30px;
            text-align: center; color: #718096;
        }
        .divider {
            height: 2px; background: linear-gradient(to right, #667eea, #764ba2);
            margin: 30px 0; border-radius: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚀 Daily Job Hunt Digest</h1>
            <p>{{ now('Asia/Manila')->format('l, F j, Y') }}</p>
        </div>

        <div class="content">
            <!-- Quick Stats -->
            <div class="stats">
                <h3>📊 Your Progress</h3>
                <p>{{ $totalApplications }} Total Applications • Stay focused!</p>
            </div>

            <!-- Tomorrow's Interviews -->
            @if($tomorrowInterviews->isNotEmpty())
                <div class="section">
                    <h2><span class="icon">🎯</span>Tomorrow's Interviews ({{ $tomorrowInterviews->count() }})</h2>
                    @foreach($tomorrowInterviews as $interview)
                        <div class="item interview-item">
                            <div class="item-title">{{ $interview->type ?? 'Interview' }}</div>
                            <div class="item-company">{{ $interview->application->role }} @ {{ $interview->application->company?->name ?? 'Company' }}</div>
                            <div class="item-meta">
                                <span class="time">⏰ {{ $interview->scheduled_at->setTimezone('Asia/Manila')->format('g:i A') }}</span>
                                @if($interview->location)
                                    <span style="margin-left: 15px;">📍 {{ $interview->location }}</span>
                                @endif
                            </div>
                            @if($interview->notes)
                                <div class="item-meta">💭 {{ $interview->notes }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="divider"></div>
            @endif

            <!-- Overdue Tasks -->
            @if($overdueTasks->isNotEmpty())
                <div class="section">
                    <h2><span class="icon">⚠️</span>Overdue Tasks ({{ $overdueTasks->count() }})</h2>
                    @foreach($overdueTasks as $task)
                        <div class="item task-item">
                            <div class="item-title">{{ $task->title }}</div>
                            @if($task->application)
                                <div class="item-company">{{ $task->application->role }} @ {{ $task->application->company?->name ?? 'Company' }}</div>
                            @endif
                            <div class="item-meta">
                                <span class="overdue-badge">📅 Due {{ $task->due_at->setTimezone('Asia/Manila')->diffForHumans() }}</span>
                            </div>
                            @if($task->description)
                                <div class="item-meta">📝 {{ $task->description }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="divider"></div>
            @endif

            <!-- No Content State -->
            @if($tomorrowInterviews->isEmpty() && $overdueTasks->isEmpty())
                <div class="no-content">
                    <h2>🎉 All Clear!</h2>
                    <p>No interviews tomorrow and no overdue tasks.<br>Perfect time to apply to more positions! 💪</p>
                </div>
            @endif

            <!-- Call to Action -->
            <div style="text-align: center;">
                <a href="{{ url('/admin') }}" class="cta">🎯 Open Dashboard</a>
            </div>
        </div>

        <div class="footer">
            <p><strong>Keep crushing your job hunt!</strong> 🚀</p>
            <p>{{ config('app.name', 'Job Hunt CRM') }} • {{ now('Asia/Manila')->format('Y') }}</p>
        </div>
    </div>
</body>
</html>