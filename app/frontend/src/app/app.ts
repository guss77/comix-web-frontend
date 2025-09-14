import { Component, signal } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { FeedListComponent } from './feed-list.component';
import { MatToolbarModule } from '@angular/material/toolbar';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet, FeedListComponent, MatToolbarModule],
  template: `
    <mat-toolbar color="primary">Comix Web Frontend</mat-toolbar>
    <div style="padding: 2rem;">
      <router-outlet />
    </div>
  `,
  styles: [],
})
export class App {}
